<?php
Route::get ('/',             'LinkController@listAllLinks')->name('links.listAll');
Route::get ('novo',          'LinkController@create'      )->name('links.create');
Route::get ('editar/{link}', 'LinkController@formEditLink')->name('links.formEditLink');
Route::get ('{link}',        'LinkController@listLink'    )->name('links.list');
Route::post('store',         'LinkController@store'       )->name('links.store');
Route::put ('edit/{link}',   'LinkController@edit'        )->name('links.edit');

Route::delete('destroy/{link}', 'LinkController@destroy')->name('links.destroy');
?>
