<?php
Route::get ('/',                   'LedgerItemController@index' )->name('ledgerItems.index');
Route::get ('pesquisar',           'LedgerItemController@search')->name('ledgerItems.search');
Route::get ('novo/{ledgerEntry}',  'LedgerItemController@create')->name('ledgerItems.create');
Route::post('store',               'LedgerItemController@store' )->name('ledgerItems.store');
Route::get ('editar/{ledgerItem}', 'LedgerItemController@edit'  )->name('ledgerItems.edit');
Route::put ('editar/{ledgerItem}', 'LedgerItemController@update')->name('ledgerItems.update');
Route::get ('{ledgerEntry}',       'LedgerItemController@show'  )->name('ledgerItems.show');

Route::delete('destroy/{ledgerItem}','LedgerItemController@destroy')->name('ledgerItems.destroy');
?>
