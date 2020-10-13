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
    //-----------users-------------
    Route::get('user/list' , 'Backend\UserController@index')->name('admin.user.list');
    Route::get('user/list/onlyTrashed' , 'Backend\UserController@onlyTrashed')->name('admin.user.onlyTrashed');
    Route::get('user/{user}/edit' , 'Backend\UserController@edit')->name('admin.user.edit');
    Route::put('user/{user}/update', 'Backend\UserController@update')->name('admin.user.update');
    Route::delete('user/{user}/delete', 'Backend\UserController@destroy')->name('admin.user.delete');
    Route::get('user/{id}/restore', 'Backend\UserController@restore')->name('admin.user.restore');
    Route::delete('user/{id}/hardDelete', 'Backend\UserController@hardDelete')->name('admin.user.hardDelete');
    //-----------roles---------------
    Route::get('role/list' , 'Backend\RoleController@index')->name('admin.role.list');
    Route::get('role/create' , 'Backend\RoleController@create')->name('admin.role.create');
    Route::post('role/store' , 'Backend\RoleController@store')->name('admin.role.store');
    Route::get('role/{role}/edit' , 'Backend\RoleController@edit')->name('admin.role.edit');
    Route::put('role/{role}/update', 'Backend\RoleController@update')->name('admin.role.update');
    Route::delete('role/{role}/delete' , 'Backend\RoleController@destroy')->name('admin.role.delete');
    //-----------permission-----------
    Route::get('permission/list' , 'Backend\PermissionController@index')->name('admin.permission.list');
    Route::get('permission/{parent_id}/listChildren' , 'Backend\PermissionController@indexChildren')->name('admin.permission.listChildren');
    Route::get('permission/create' , 'Backend\PermissionController@create')->name('admin.permission.create');
    Route::post('permission/storeParent' , 'Backend\PermissionController@storeParent')->name('admin.permission.storeParent');
    Route::post('permission/storeChildren' , 'Backend\PermissionController@storeChildren')->name('admin.permission.storeChildren');
    Route::get('permission/{permission}/edit' , 'Backend\PermissionController@edit')->name('admin.permission.edit');
    Route::put('permission/{permission}/update', 'Backend\PermissionController@update')->name('admin.permission.update');
    Route::delete('permission/{permission}/delete', 'Backend\PermissionController@destroy')->name('admin.permission.delete');
});


// ------------------------- FrontEnd ----------------------
Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/{page}', 'Frontend\StoreController@index')->name('store');
Route::get('/{page}/{productName}', 'Frontend\ProductDetail@index')->name('product');