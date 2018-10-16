<?php

Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login')->name('login');
Route::post('logout', 'UsersController@logout');

Route::post('admin/login', 'AdminController@login');
Route::post('admin/logout', 'AdminController@logout');
Route::post('admin', 'AdminController@index');

Route::resource('items', 'ItemsController');
Route::get('items/category/{id}', 'ItemsController@category');
Route::get('slide', 'ItemsController@slide');

Route::resource('carts', 'CartsController');
Route::get('total', 'CartsController@total');
Route::get('count', 'CartsController@count');
Route::post('checkout', 'CartsController@checkout');

Route::get('admin/payments', 'PaymentsController@index');
Route::get('admin/{id}/payments', 'PaymentsController@user');
