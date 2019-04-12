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
Route::group(['middleware' => 'web'], function () {
Route::get('/login',['uses'=>'Auth\MyAuthController@showLogin','as'=>'login']);
Route::post('/login',['uses'=>'Auth\MyAuthController@authenticate']);
Route::get('/home', 'HomeController@index')->name('home');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@postRegister']);
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);

});


Route::post('ajax', ['middleware' => ['auth','web'],'as' => 'ajax', 'uses' => 'AjaxController@store2']);
Route::post('/spisoc', ['uses' => 'SpisocController@index'])->name('spisoc');
Route::get('/spisoc', ['uses' => 'SpisocController@index'])->name('spisoc');;


Route::group(['prefix'=>'admin','middleware'=>['web','auth']],function() {
Route::resource('/','Admin\ZadanieController');
Route::resource('zadanie','Admin\ZadanieController');
Route::post('/yvedom', ['uses' => 'Admin\YvedomController@index'])->name('yvedom');
Route::get('/yvedom', ['uses' => 'Admin\YvedomController@index'])->name('yvedom');
Route::post('/vrabote', ['uses' => 'Admin\YvedomController@vrabote'])->name('vrabote');
Route::get('/vrabote', ['uses' => 'Admin\YvedomController@vrabote'])->name('vrabote');
Route::post('/zarplata', ['uses' => 'Admin\YvedomController@pluskzarplate'])->name('zarplata');
Route::get('/zarplata', ['uses' => 'Admin\YvedomController@pluskzarplate'])->name('zarplata');
Route::post('/zarplata2', ['uses' => 'Admin\YvedomController@minuskzarplate'])->name('zarplata2');
Route::get('/zarplata2', ['uses' => 'Admin\YvedomController@minuskzarplate'])->name('zarplata2');
});
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  