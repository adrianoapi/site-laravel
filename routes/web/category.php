<?php
Route::get('{category}', 'CategoryController@show');
Route::get('novo', 'CategoryController@create');
Route::post('store', 'CategoryController@store')->name('category.store');
?>
