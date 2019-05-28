<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/display', 'UserController@show'); 

Route::post('/store','HomeController@store');

Route::get('/filter','HomeController@filter');

Route::get('/comment/{id}','CommentsController@comment');

Route::get('/deletecom/{id}/{carid}','CommentsController@delete');

// Route::get('/filterform','HomeController@filterform');

Route::get('/view/{id}','HomeController@view');

Route::get('/download/{id}','HomeController@download');

Route::get('/excel','UserController@export'); //excel

Route::get('/edit/{id}','HomeController@edit');

Route::post('/update/{id}','HomeController@update');

Route::get('/delete/{id}','HomeController@destroy');


Route::get('/type', 'CarTypesController@index');

Route::post('/store/type','CarTypesController@store');

Route::get('/delete/type/{id}','CarTypesController@destroy');


Route::get('/brand', 'BrandController@index');

Route::post('/store/brand','BrandController@store');

Route::get('/delete/brand/{id}','BrandController@destroy');


Route::get('/color', 'ColorController@index');

Route::post('/store/color','ColorController@store');

Route::get('/delete/color/{id}','ColorController@destroy');

Route::get('/currency','UserController@currency');

Route::get('/getvalue','UserController@getvalue');