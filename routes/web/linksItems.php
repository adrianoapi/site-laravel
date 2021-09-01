<?php

Route::get ('/',                 'LinkItemController@listAllLinksItems')->name('linksItems.listAll');
Route::get ('novo',              'LinkItemController@create'           )->name('linksItems.create');
Route::post('store',             'LinkItemController@store'            )->name('linksItems.store');
Route::put ('edit/{linkItem}',   'LinkItemController@edit'             )->name('linksItems.edit');
Route::get ('{linkItem}',        'LinkItemController@list'             )->name('linksItems.list');
Route::get ('editar/{linkItem}', 'LinkItemController@formEditLink'     )->name('linksItems.formEditLink');

Route::delete('destroy/{linkItem}', 'LinkItemController@destroy')->name('linksItems.destroy');

?>
