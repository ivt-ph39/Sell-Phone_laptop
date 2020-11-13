<?php

use App\Model\Blog;
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

Route::get('admin/password/reset', 'Backend\adminAuth\ResetPasswordController@index')->name('admin.password.reset');
Route::post('admin/password/reset', 'Backend\adminAuth\ResetPasswordController@store')->name('admin.password.reset-store');
Route::get('admin/password/reset/{token}', 'Backend\adminAuth\ResetPasswordController@showFormReset')->name('admin.showFormReset')->middleware('signed');
Route::post('admin/password/handleReset', 'Backend\adminAuth\ResetPasswordController@storeFormReset')->name('admin.storeFormReset');

Route::group(['prefix' => 'admin', 'middleware' => 'checkLoginAdmin'], function () {

    Route::get('home', 'Backend\HomeAdminController@index')->name('admin.home');
    //---------categories----------
    Route::get('category/list', 'Backend\CategoryController@index')->name('admin.category.list')->middleware('can:list_category');
    Route::get('category/create', 'Backend\CategoryController@create')->name('admin.category.create');
    Route::post('category/store', 'Backend\CategoryController@store')->name('admin.category.store');
    Route::get('category/show/{id}', 'Backend\CategoryController@show')->name('admin.category.show');
    Route::get('category/edit/{id}', 'Backend\CategoryController@edit')->name('admin.category.edit');
    Route::put('category/update/{id}', 'Backend\CategoryController@update')->name('admin.category.update');
    Route::delete('category/delete/{id}', 'Backend\CategoryController@delete')->name('admin.category.delete');
    //---------products----------
    Route::get('product/list', 'Backend\ProductController@index')->name('admin.product.list')->middleware('can:list_product');
    Route::get('product/create', 'Backend\ProductController@create')->name('admin.product.create');
    Route::post('product/store', 'Backend\ProductController@store')->name('admin.product.store');
    Route::get('product/edit/{id}', 'Backend\ProductController@edit')->name('admin.product.edit');
    Route::post('product/update/{id}', 'Backend\ProductController@update')->name('admin.product.update');
    Route::delete('product/delete/{id}', 'Backend\ProductController@destroy')->name('admin.product.delete');

    Route::post('ckeditor/image_upload', 'Backend\ProductController@upload')->name('upload');

    //---------brands----------
    Route::get('brand/list', 'Backend\BrandController@index')->name('admin.brand.list')->middleware('can:list_brand');
    Route::get('brand/create', 'Backend\BrandController@create')->name('admin.brand.create');
    Route::get('brand/{id}/edit', 'Backend\BrandController@edit')->name('admin.brand.edit');
    Route::post('brand/store', 'Backend\BrandController@store')->name('admin.brand.store');
    Route::put('brand/{id}/update', 'Backend\BrandController@update')->name('admin.brand.update');
    Route::delete('brand/{id}/delete', 'Backend\BrandController@delete')->name('admin.brand.delete');
    //---------contacts----------
    Route::get('contact/list', 'Backend\ContactController@index')->name('admin.contact.list')->middleware('can:list_contact');
    Route::get('contact/create', 'Backend\ContactController@create')->name('admin.contact.create');
    Route::get('contact/{id}/edit', 'Backend\ContactController@edit')->name('admin.contact.edit');
    Route::post('contact/store', 'Backend\ContactController@store')->name('admin.contact.store');
    Route::put('contact/{id}/update', 'Backend\ContactController@update')->name('admin.contact.update');
    Route::delete('contact/{id}/delete', 'Backend\ContactController@delete')->name('admin.contact.delete');
    //---------sliders----------
    Route::get('slider/list', 'Backend\SliderController@index')->name('admin.slider.list')->middleware('can:list_slider');
    Route::get('slider/create', 'Backend\SliderController@create')->name('admin.slider.create');
    Route::get('slider/{id}/edit', 'Backend\SliderController@edit')->name('admin.slider.edit');
    Route::post('slider/store', 'Backend\SliderController@store')->name('admin.slider.store');
    Route::put('slider/{id}/update', 'Backend\SliderController@update')->name('admin.slider.update');
    Route::delete('slider/{id}/delete', 'Backend\SliderController@delete')->name('admin.slider.delete');
    //-----------users-------------
    Route::get('user/list', 'Backend\UserController@index')->name('admin.user.list')->middleware('can:admin_manager');
    Route::get('user/list/onlyTrashed', 'Backend\UserController@onlyTrashed')->name('admin.user.onlyTrashed');
    Route::get('user/create', 'Backend\UserController@create')->name('admin.user.create');
    Route::post('user/store', 'Backend\UserController@store')->name('admin.user.store');
    Route::get('user/{user}/edit', 'Backend\UserController@edit')->name('admin.user.edit');
    Route::put('user/{user}/update', 'Backend\UserController@update')->name('admin.user.update');
    Route::delete('user/{user}/delete', 'Backend\UserController@destroy')->name('admin.user.delete');
    Route::get('user/{id}/restore', 'Backend\UserController@restore')->name('admin.user.restore');
    Route::delete('user/{id}/hardDelete', 'Backend\UserController@hardDelete')->name('admin.user.hardDelete');
    //-----------roles---------------
    Route::get('role/list', 'Backend\RoleController@index')->name('admin.role.list')->middleware('can:admin_manager');
    Route::get('role/create', 'Backend\RoleController@create')->name('admin.role.create');
    Route::post('role/store', 'Backend\RoleController@store')->name('admin.role.store');
    Route::get('role/{role}/edit', 'Backend\RoleController@edit')->name('admin.role.edit');
    Route::put('role/{role}/update', 'Backend\RoleController@update')->name('admin.role.update');
    Route::delete('role/{role}/delete', 'Backend\RoleController@destroy')->name('admin.role.delete');
    //-----------permission-----------
    Route::get('permission/list', 'Backend\PermissionController@index')->name('admin.permission.list')->middleware('can:admin_manager');
    Route::get('permission/{parent_id}/listChildren', 'Backend\PermissionController@indexChildren')->name('admin.permission.listChildren');
    Route::get('permission/{parent}/create', 'Backend\PermissionController@create')->name('admin.permission.create');
    Route::post('permission/storeParent', 'Backend\PermissionController@storeParent')->name('admin.permission.storeParent');
    Route::post('permission/storeChildren', 'Backend\PermissionController@storeChildren')->name('admin.permission.storeChildren');
    Route::get('permission/{permission}/edit', 'Backend\PermissionController@edit')->name('admin.permission.edit');
    Route::put('permission/{permission}/updateChildren', 'Backend\PermissionController@updateChildren')->name('admin.permission.updateChildren');
    Route::put('permission/{permission}/updateParent', 'Backend\PermissionController@updateParent')->name('admin.permission.updateParent');
    Route::delete('permission/{permission}/delete', 'Backend\PermissionController@destroy')->name('admin.permission.delete');
    Route::delete('permission/{permission}/deleteChildren', 'Backend\PermissionController@destroyChildren')->name('admin.permission.deleteChildren');
    //------------comment----
    Route::get('comment/list', 'Backend\CommentController@index')->name('admin.comment.list')->middleware('can:list_comment');
    Route::put('comment/{comment}/active', 'Backend\CommentController@active')->name('admin.comment.active');
    Route::get('comment/{id}/showReply', 'Backend\CommentController@showReply')->name('admin.comment.showReply');
    Route::post('comment/{id}/reply', 'Backend\CommentController@reply')->name('admin.comment.reply');
    Route::get('comment/showMess', 'Backend\CommentController@showMessage')->name('admin.comment.showMess');
    Route::delete('comment/{comment}/destroy', 'Backend\CommentController@destroy')->name('admin.comment.destroy');
    //-------------Blog------
    Route::get('blog/list', 'Backend\BlogController@index')->name('admin.blog.list')->middleware('can:list_blog');
    Route::get('blog/create', 'Backend\BlogController@create')->name('admin.blog.create');
    Route::post('blog/store', 'Backend\BlogController@store')->name('admin.blog.store');
    Route::get('blog/{blog}/show', 'Backend\BlogController@edit')->name('admin.blog.show');
    Route::put('blog/{blog}/update', 'Backend\BlogController@update')->name('admin.blog.update');
    Route::delete('blog/{blog}/destroy', 'Backend\BlogController@destroy')->name('admin.blog.delete')->middleware('can:delete_blog');
    // ------------Order-----------
    Route::get('order/list' , 'Backend\OrderController@index')->name('admin.order.list')->middleware('can:list_blog');
    Route::put('order/{order}/update' , 'Backend\OrderController@update')->name('admin.order.update');
    Route::delete('order/{order}/destroy', 'Backend\OrderController@destroy')->name('admin.order.destroy');
    Route::get('order/{id}/productOrder', 'Backend\OrderController@productOrder')->name('admin.order.productOrder');
});
// ------------------------- FrontEnd ----------------------
Route::get('/home', 'Frontend\HomeController@index')->name('home');
Route::get('/', 'Frontend\HomeController@index');
// ---------Register-login-User--------
Route::post('dang-ky', 'Frontend\UserController@register')->name('user_register');
Route::post('dang-nhap', 'Frontend\UserController@login')->name('user_login');
Route::get('dang-xuat', 'Frontend\UserController@logout')->name('user_logout');
// ---------End--Register-login-User--------

// ---------Account-User--------
Route::get('tai-khoang', 'Frontend\UserController@getAccount')->name('user_account');


// ---------End-Account-User--------

// ---------Comment-User--------
Route::post('create-comment', 'Backend\CommentController@store')->name('comment_store');

// ---------Rating-Product--------
Route::post('create-rating', 'Backend\RatingController@store')->name('rating_store');

// ---------Order----------
Route::post('create-order', 'Backend\OrderController@store')->name('order_store');
Route::post('order/cancelOrder', 'Backend\OrderController@cancelOrder')->name('order.cancelOrder');
Route::post('order/deleteAjax', 'Backend\OrderController@deleteAjax')->name('order.deleteOrder');
Route::post('order-detail', 'Backend\OrderController@show')->name('order_show');
Route::post('get-quantity-product', 'Backend\OrderController@getQuantityProduct')->name('order_getQuantityProduct');



// ----------SearchProduct TypeaheadJs--------
Route::get('search/name', 'Frontend\SearchProduct@searchTypeaheadJs');
// ----------SearchProduct List--------
Route::get('search', 'Frontend\SearchProduct@search')->name('search_product_list');

Route::get('/gio-hang', 'Frontend\CartController@index')->name('cart');


Route::get('/{page}', 'Frontend\StoreController@index')->name('store');
// Route::get('/{page}/{productName}', 'Frontend\ProductDetail@index')->name('product');


Route::get('/product/{productName}', 'Frontend\ProductDetail@index')->name('product');

Route::get('/{page}', 'Frontend\StoreController@index')->name('store');

Route::post('/getRatings', 'Frontend\ProductDetail@getRatings')->name('get_ratings');
Route::post('/getComments', 'Frontend\ProductDetail@getComments')->name('get_comments');

//-------------blog---------------
Route::get('blog/home' , 'Frontend\BlogController@index')->name('blog');
Route::get('blog/{slug}' , 'Frontend\BlogController@blogContent')->name('blog.content');