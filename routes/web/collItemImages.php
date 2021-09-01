<?php
Route::get ('/novo/{collItem}', 'CollectionItemImageController@create')->name('collItemImages.create');
Route::post('store',            'CollectionItemImageController@store' )->name('collItemImages.store');

Route::delete('destroy/{collItemImage}', 'CollectionItemImageController@destroy')->name('collItemImages.destroy');
?>
