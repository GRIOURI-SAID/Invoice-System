<?php

namespace App\Http\Controllers;

use App\Models\invocie;
use App\Models\invoices_attachment;
use App\Models\invoices_details;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvocieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invocie::all();
        return view('invoices.invoices' , [
            "invoices" => $invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view("invoices.create_invoices" ,[
            "sections" =>$sections
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invocie::create([
            "invoice_number" => $request->invoice_number,
            "invoice_Date"  => $request->invoice_date,
            "Due_date"  => $request->Due_date,
            "product"   =>$request->produit,
            "section_id" =>$request->section,
            "Amount_collection" =>$request->Amount_collection,
            "Amount_Commission" => $request->Amount_Commission,
            "Discount"  =>$request-> Discount,
            "Value_VAT" =>$request->Value_VAT,
            "Rate_VAT"=>$request->Rate_VAT,
            "Total" =>$request->Total,
             'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id =invocie::latest()->first()->id;

         invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->produit,
            'Section' => $request->section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);


         if ($request->hasFile('image')) {

            $invoice_id = invocie::latest()->first()->id;
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function show(invocie $invocie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id =$request->id;
        $invocie = invocie::find($id);


       return view("invoices.edit_invoices" ,["invoice"  => $invocie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invocie $invocie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function destroy(invocie $invocie)
    {
        //
    }



    public function getproduit($id){
        $product= DB::table('products')->where("section_id" , $id)->pluck("name" , 'id');

        return json_encode($product);
    }
}
