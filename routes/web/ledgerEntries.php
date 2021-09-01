<?php

Route::get ('/',                    'LedgerEntryController@index' )->name('ledgerEntries.index');
Route::get ('novo',                 'LedgerEntryController@create')->name('ledgerEntries.create');
Route::post('store',                'LedgerEntryController@store' )->name('ledgerEntries.store');
Route::get ('editar/{ledgerEntry}', 'LedgerEntryController@edit'  )->name('ledgerEntries.edit');
Route::put ('editar/{ledgerEntry}', 'LedgerEntryController@update')->name('ledgerEntries.update');
Route::get ('{ledgerEntry}',        'LedgerEntryController@show'  )->name('ledgerEntries.show');

Route::delete('destroy/{ledgerEntry}', 'LedgerEntryController@destroy')->name('ledgerEntries.destroy');

?>
