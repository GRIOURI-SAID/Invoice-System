<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});




Auth::routes();




Route::resource("invoices" ,InvocieController::class);
Route::get('/invoices/edit/{id}' ,'InvocieController@edit');
Route::get("/InvoicesDetails/{id}" ,'InvoicesDetailsController@getInvoiceDetails');
Route::get("/section/{id}" ,'InvocieController@getproduit');
Route::get("/View_file/{id_invoice}/{name}",'InvoicesAttachmentController@getfile');
Route::resource("sections" , SectionsController::class);
Route::resource("products" , ProductsController::class);
Route::get('/{page}', 'AdminController@index');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
