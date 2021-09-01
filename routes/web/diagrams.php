<?php

Route::get('/', 'DiagramController@index')->name('diagrams.index');
Route::get('novo', 'DiagramController@create')->name('diagrams.create');
Route::post('store', 'DiagramController@store')->name('diagrams.store');
Route::get('editar/{diagram}', 'DiagramController@edit')->name('diagrams.edit');
Route::put('editar/{diagram}', 'DiagramController@update')->name('diagrams.update');

Route::delete('destroy/{diagram}', 'DiagramController@destroy')->name('diagrams.destroy');

?>
