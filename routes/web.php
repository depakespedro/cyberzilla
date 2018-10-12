<?php

Auth::routes();

Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/user/{id}', 'UsersController@show')->name('user.show');
Route::post('/user/{id}', 'UsersController@update')->name('user.update');
Route::delete('/user/{id}', 'UsersController@delete')->name('user.delete');
