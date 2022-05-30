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
    return view('welcome');
});

Route::resource('medicines', 'MedicineController');
Route::resource('categories', 'CategoryController')->middleware('auth');

Route::get('coba1', 'MedicineController@coba1');
Route::get('coba2', 'MedicineController@coba2');
Route::get('coba3', 'CategoryController@coba2');
Route::post('/medicines/showInfo', 'MedicineController@showInfo')->name('medicines.showInfo');

Route::get('report/listmedicine/{id}','CategoryController@showlist');
Route::get('report/highestpricemedicine','CategoryController@showHighestPriceMedList');

Route::resource('transactions', 'TransactionController');
Route::post('transactions/showDataAjax', 'TransactionController@showAjax')
    ->name('transactions.showAjax');
Route::get('transactions/showDataAjax2/{id}', 'TransactionController@showAjax2')
    ->name('transactions.showAjax2');

Route::middleware(['auth'])->group(function(){
    Route::resource('suppliers', 'SupplierController');
    Route::post('/supplier/getEditForm', 'SupplierController@getEditForm')->name('supplier.getEditForm');
    Route::post('/supplier/getEditForm2', 'SupplierController@getEditForm2')->name('supplier.getEditForm2');
    Route::post('/supplier/deleteData', 'SupplierController@deleteData')->name('supplier.deleteData');
    Route::post('/supplier/saveData', 'SupplierController@saveData')->name('supplier.saveData');
});

Route::post('/medicine/getEditForm', 'MedicineController@getEditForm')->name('medicine.getEditForm');
Route::post('/medicine/getEditForm2', 'MedicineController@getEditForm2')->name('medicine.getEditForm2');
Route::post('/medicine/deleteData', 'MedicineController@deleteData')->name('medicine.deleteData');
Route::post('/medicine/saveData', 'MedicineController@saveData')->name('medicine.saveData');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
