<?php

Auth::routes();

Route::get('/', function () { return redirect()->route('users.index'); });
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/user/form', 'UsersController@createForm')->name('user.create.form');
Route::post('/user', 'UsersController@create')->name('user.create');
Route::get('/user/{id}', 'UsersController@show')->name('user.show');
Route::post('/user/{id}', 'UsersController@update')->name('user.update');
Route::delete('/user/{id}', 'UsersController@delete')->name('user.delete');
