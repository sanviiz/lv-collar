<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('info/{id}','InfoController@index');

Auth::routes();

//Fking API 
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/try','SOSController@tryindex');

Route::post('/try/api','SOSController@send_json');  //laravel->vue

Route::post('/try/vueapi','SOSController@vue_json'); //vue->laravel

Route::post('/try/searchapi','SOSController@search_api');

Route::post('/try/destroyapi/','SOSController@destroy_api');

Route::post('try/email','SOSController@email');


//Safezone API
Route::post('/api/safezone/get','SafezoneController@get_safezone'); //get safezone Api

Route::post('/api/safezone/add','SafezoneController@add_safezone'); //add safezone Api

Route::post('/api/safezone/edit','SafezoneController@edit_safezone'); //edit safezone API

Route::post('/api/safezone/delete','SafezoneController@delete_safezone'); //delete safezone

//NavBar API
Route::post('/api/navbar/name','HomeController@getname_navbar');




