<?php
Route::get('/', 'AuthController@dashboard')->name('admin');
Route::get('/login', 'AuthController@showLoginForm')->name('admin.login');
Route::get('/logout', 'AuthController@logout')->name('admin.logout');
Route::post('/login/do', 'AuthController@login')->name('admin.login.do');
?>
