<?php

Route::get ('/',                    'LedgerGroupController@index' )->name('ledgerGroups.index');
Route::get ('novo',                 'LedgerGroupController@create')->name('ledgerGroups.create');
Route::get ('organizar',            'LedgerGroupController@organize')->name('ledgerGroups.organize');
Route::post('store',                'LedgerGroupController@store' )->name('ledgerGroups.store');
Route::get ('editar/{ledgerGroup}', 'LedgerGroupController@edit'  )->name('ledgerGroups.edit');
Route::put ('editar/{ledgerGroup}', 'LedgerGroupController@update')->name('ledgerGroups.update');
Route::get ('{ledgerGroup}',        'LedgerGroupController@show'  )->name('ledgerGroups.show');

Route::delete('destroy/{ledgerGroup}', 'LedgerGroupController@destroy')->name('ledgerGroups.destroy');

?>
