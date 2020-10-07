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




// ------------------------- Backend ----------------------

Route::get('admin/login', 'Backend\adminAuth\LoginAdController@showLoginAdmin')->name('admin.login');
Route::post('admin/login', 'Backend\adminAuth\LoginAdController@store')->name('admin.store');
Route::get('admin/logout', 'Backend\adminAuth\LoginAdController@logout')->name('admin.logout');

Route::get('admin/register', 'Backend\adminAuth\RegisterAdController@showRegisterAdmin')->name('admin.register');
Route::post('admin/register', 'Backend\adminAuth\RegisterAdController@store')->name('admin.register.store');
Route::get('admin/register-success', 'Backend\adminAuth\RegisterAdController@success')->name('admin.register-success');


Route::get('admin/password/reset', 'Backend\adminAuth\ResetPasswordController@index')->name('admin.password.reset');
Route::post('admin/password/reset', 'Backend\adminAuth\ResetPasswordController@store')->name('admin.password.reset-store');
Route::get('admin/password/reset/{token}', 'Backend\adminAuth\ResetPasswordController@showFormReset')->name('admin.showFormReset')->middleware('signed');
Route::post('admin/password/handleReset', 'Backend\adminAuth\ResetPasswordController@storeFormReset')->name('admin.storeFormReset');

Route::group(['prefix' => 'admin', 'middleware' => 'checkLoginAdmin'], function () {

    Route::get('home', 'Backend\HomeAdminController@index')->name('admin.home');
    //---------categories----------
    Route::get('category/list', 'Backend\CategoryController@index')->name('admin.category.list');
    Route::get('category/create', 'Backend\CategoryController@create')->name('admin.category.create');
    Route::post('category/store', 'Backend\CategoryController@store')->name('admin.category.store');
    Route::get('category/show/{id}', 'Backend\CategoryController@show')->name('admin.category.show');
    Route::get('category/edit/{id}', 'Backend\CategoryController@edit')->name('admin.category.edit');
    Route::post('category/update/{id}', 'Backend\CategoryController@update')->name('admin.category.update');
    Route::get('category/delete/{id}', 'Backend\CategoryController@destroy')->name('admin.category.delete');
    //---------products----------
    Route::get('product/list', 'Backend\ProductController@index')->name('admin.product.list');
    Route::get('product/create', 'Backend\ProductController@create')->name('admin.product.create');
    Route::post('product/store', 'Backend\ProductController@store')->name('admin.product.store');
    Route::get('product/edit/{id}', 'Backend\ProductController@edit')->name('admin.product.edit');
    Route::post('product/update/{id}', 'Backend\ProductController@update')->name('admin.product.update');
    Route::get('product/delete/{id}', 'Backend\ProductController@destroy')->name('admin.product.delete');
    //---------brands----------
    Route::get('brand/list', 'Backend\BrandController@index')->name('admin.brand.list');
    Route::get('brand/create', 'Backend\BrandController@create')->name('admin.brand.create');
    Route::get('brand/{id}/edit', 'Backend\BrandController@edit')->name('admin.brand.edit');
    Route::post('brand/store', 'Backend\BrandController@store')->name('admin.brand.store');
    Route::put('brand/{id}/update', 'Backend\BrandController@update')->name('admin.brand.update');
    //---------contacts----------
    Route::get('contact/list', 'Backend\ContactController@index')->name('admin.contact.list');
    Route::get('contact/create', 'Backend\ContactController@create')->name('admin.contact.create');
    Route::get('contact/{id}/edit', 'Backend\ContactController@edit')->name('admin.contact.edit');
    Route::post('contact/store', 'Backend\ContactController@store')->name('admin.contact.store');
    Route::put('contact/{id}/update', 'Backend\ContactController@update')->name('admin.contact.update');
    Route::delete('contact/{id}/delete', 'Backend\ContactController@delete')->name('admin.contact.delete');
    //---------sliders----------
    Route::get('slider/list', 'Backend\SliderController@index')->name('admin.slider.list');
    Route::get('slider/create', 'Backend\SliderController@create')->name('admin.slider.create');
    Route::get('slider/{id}/edit', 'Backend\SliderController@edit')->name('admin.slider.edit');
    Route::post('slider/store', 'Backend\SliderController@store')->name('admin.slider.store');
    Route::put('slider/{id}/update', 'Backend\SliderController@update')->name('admin.slider.update');
    Route::delete('slider/{id}/delete', 'Backend\SliderController@delete')->name('admin.slider.delete');
});


// ------------------------- FrontEnd ----------------------
Route::get('/', 'Frontend\HomeController@index')->name('home');