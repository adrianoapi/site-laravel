<?php
Route::get('/',               'PasswordController@index' )->name('passwords.index');
Route::get('novo',            'PasswordController@create')->name('passwords.create');
Route::post('store',          'PasswordController@store' )->name('passwords.store');
Route::get('edit/{password}', 'PasswordController@edit'  )->name('passwords.edit');
Route::put('edit/{password}', 'PasswordController@update')->name('passwords.update');
Route::get('{password}',      'PasswordController@show'  )->name('passwords.show');
Route::post('visualizar',     'PasswordController@show'  )->name('passwords.show');

Route::delete('destroy/{password}', 'PasswordController@destroy')->name('passwords.destroy');
?>
