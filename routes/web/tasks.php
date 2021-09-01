<?php

Route::get ('/',             'TaskController@index'   )->name('tasks.index');
Route::get ('novo',          'TaskController@create'  )->name('tasks.create');
Route::post('store',         'TaskController@store'   )->name('tasks.store');
Route::post('upAjax',        'TaskController@upAjax'  )->name('tasks.ajax');
Route::post('addAjax',       'TaskController@addAjax' )->name('tasks.addAjax');
Route::post('delAjax',       'TaskController@delAjax' )->name('tasks.delAjax');
Route::post('Arquivar',      'TaskController@Arquivar')->name('tasks.Arquivar');
Route::get ('editar/{task}', 'TaskController@edit'    )->name('tasks.edit');
Route::put ('editar/{task}', 'TaskController@update'  )->name('tasks.update');
Route::get ('{task}',        'TaskController@show'    )->name('tasks.show');

Route::delete('destroy/{task}', 'TaskController@destroy')->name('tasks.destroy');

?>
