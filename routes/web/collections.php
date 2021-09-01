<?php
Route::get('/',                 'CollectionController@index' )->name('collections.index');
Route::get('novo',              'CollectionController@create')->name('collections.create');
Route::post('store',            'CollectionController@store' )->name('collections.store');
Route::get('edit/{collection}', 'CollectionController@edit'  )->name('collections.edit');
Route::put('edit/{collection}', 'CollectionController@update')->name('collections.update');
Route::get('{collection}',      'CollectionController@show'  )->name('collections.show');

Route::delete('destroy/{collection}', 'CollectionController@destroy')->name('collections.destroy');
?>
