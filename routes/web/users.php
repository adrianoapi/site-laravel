<?php
Route::get('/usuario/injection', 'UserController@index')->name('user.index');
Route::get('/usuario/{id}', 'UserController@show')->name('user.listUser');
Route::get('/usuario', 'UserController@show')->name('users.listAll');
?>
