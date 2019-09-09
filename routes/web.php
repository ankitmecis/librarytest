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
// Route::get('/organization/create', 'OrganizationController@create')->name('organization.create');
// Route::put('/organization/update', 'OrganizationController@update')->name('organization.update');
// Route::get('/organization/show/{id}', 'OrganizationController@show')->name('organization.show');
// Route::get('/organization/edit/{id}', 'OrganizationController@edit')->name('organization.edit');
// Route::delete('/organization/destroy', 'OrganizationController@destroy')->name('organization.destroy');
// Route::post('/organization/store', 'OrganizationController@store')->name('organization.store');

Route::resource('organization', 'OrganizationController');