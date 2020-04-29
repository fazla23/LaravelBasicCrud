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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('contact', function () {
//     return view('contact');
// });

Route::get('/','UploadController@index');
Route::get('contact','ContactFormController@create')->name('contact.create');
Route::post('contact','ContactFormController@store')->name('contact.store');

Route::view('/about','about');

// Route::view('/about','about')->middleware('test'); //It was used for testing the middleware

Route::get('customers','CustomerController@index')->name('csutomers.index');
Route::get('customers/create','CustomerController@create')->name('csutomers.create');
Route::post('customers','CustomerController@store')->name('customers.store');
Route::get('customers/{customer}','CustomerController@show')->middleware('can:view,customer');
Route::get('customers/{customer}/edit','CustomerController@edit')->name('csutomers.edit');
Route::patch('customers/{customer}','CustomerController@update')->name('csutomers.update');
Route::delete('customers/{customer}','CustomerController@destroy')->name('csutomers.destroy');

//Route::resource('customers','CustomerController'); //All of the routes are handled by this one line... 

//Route::resource('customers','CustomerController')->middleware('auth');  //authentication at the route level
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


