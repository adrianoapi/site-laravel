<?php
Route::get ('/',                 'CollectionItemController@index' )->name('collItems.index');
Route::get ('novo/{collection}', 'CollectionItemController@create')->name('collItems.create');
Route::post('store',             'CollectionItemController@store' )->name('collItems.store');
Route::post ('visualizar',       'CollectionItemController@view'  )->name('collItems.view');
Route::get ('edit/{collItem}',   'CollectionItemController@edit'  )->name('collItems.edit');
Route::put ('edit/{collItem}',   'CollectionItemController@update')->name('collItems.update');
Route::get ('{collection}',      'CollectionItemController@show'  )->name('collItems.show');

Route::delete('destroy/{collItem}', 'CollectionItemController@destroy')->name('collItems.destroy');
?>
