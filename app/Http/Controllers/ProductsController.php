<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = sections::all();
        $product = Products::all();
       return view("products.products" ,[
           "products" => $product,
           "sections"  =>$section
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validationData = $request->validate([
             "name" => "required|unique:Products"
         ],[
             "name.required" =>  "يرجي ادخال اسم القسم",
              "name.unique" =>  "",

         ]);

         Products::create([
             "name" => $request->name,
             "description" => $request->description,
             "section_id"  => $request->section_id
         ]);


          session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $id = $request->id;

     $this->validate($request, [
          "name" => "required|unique:Products,name".$id
     ], [
         "name.required" =>  "يرجي ادخال اسم المنتج",
         "name.unique" =>  "",
     ]);

     $product = Products::find($id);


     $product->update([
        "name"=> $request->name,
        "description" =>$request->description,
        "section_id" =>$request->section_id
     ]);




     session()->flash('edit','تم تعديل المنتج بنجاج');

        return redirect("/products");


    }

    /**
     * Remove the specified resource from storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Products::find($id)->delete();
       session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');

    }
}
