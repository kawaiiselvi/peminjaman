<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']], function(){
	Route::resource('penanggungs','PenanggungsController');
	Route::resource('barangs','BarangsController');
	Route::resource('members', 'MembersController');
	Route::get('statistics',[
		'as'=>'statistics.index',
		'uses'=>'StatisticsController@index'
	]);
});

Route::get('barangs/{barang}/borrow', [
	'middleware'=>['auth','role:member'],
	'as'=>'guest.barangs.borrow',
	'uses'=>'BarangsController@borrow']);

Route::put('barangs/{barang}/return', [
	'middleware'=>['auth','role:member'],
	'as'=>'member.barangs.return',
	'uses'=>'BarangsController@returnBack']);

Route::get('auth/verify/{token}','Auth\RegisterController@verify');
Route::get('settings/profile','SettingsController@profile');
Route::get('settings/profile/edit','SettingsController@editProfile');
Route::post('settings/profile','SettingsController@updateProfile');
Route::get('settings/password','SettingsController@editPassword');
Route::post('settings/password','SettingsController@updatePassword');
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

