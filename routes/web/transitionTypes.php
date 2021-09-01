<?php

Route::get ('/',                       'TransitionTypeController@index' )->name('transitionTypes.index');
Route::get ('novo',                    'TransitionTypeController@create')->name('transitionTypes.create');
Route::post('store',                   'TransitionTypeController@store' )->name('transitionTypes.store');
Route::get ('editar/{transitionType}', 'TransitionTypeController@edit'  )->name('transitionTypes.edit');
Route::put ('editar/{transitionType}', 'TransitionTypeController@update')->name('transitionTypes.update');
Route::get ('{transitionType}',        'TransitionTypeController@show'  )->name('transitionTypes.show');

Route::delete('destroy/{transitionType}', 'TransitionTypeController@destroy')->name('transitionTypes.destroy');

?>
