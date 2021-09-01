<?php

Route::get ('/',                  'FixedCostController@index' )->name('fixedCosts.index');
Route::get ('novo',               'FixedCostController@create')->name('fixedCosts.create');
Route::get('trash',               'FixedCostController@trash' )->name('fixedCosts.trash');
Route::get('pesquisar',           'FixedCostController@search')->name('fixedCosts.search');
Route::post('store',              'FixedCostController@store' )->name('fixedCosts.store');
Route::get ('editar/{fixedCost}', 'FixedCostController@edit'  )->name('fixedCosts.edit');
Route::get ('lancar/{fixedCost}', 'FixedCostController@entry' )->name('fixedCosts.entry');
Route::put ('editar/{fixedCost}', 'FixedCostController@update')->name('fixedCosts.update');
Route::get ('{fixedCost}',        'FixedCostController@show'  )->name('fixedCosts.show');

Route::put ('restaurar/{fixedCost}', 'FixedCostController@recycle')->name('fixedCosts.recycle');
Route::delete('destroy/{fixedCost}', 'FixedCostController@destroy')->name('fixedCosts.destroy');

?>
