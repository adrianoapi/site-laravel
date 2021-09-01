<?php

Route::get ('/',                  'TaskGroupController@index' )->name('taskGroups.index');
Route::get ('novo',               'TaskGroupController@create')->name('taskGroups.create');
Route::post('store',              'TaskGroupController@store' )->name('taskGroups.store');
Route::get ('editar/{taskGroup}', 'TaskGroupController@edit'  )->name('taskGroups.edit');
Route::put ('edit/{taskGroup}',   'TaskGroupController@update')->name('taskGroups.update');
Route::get ('{taskGroup}',        'TaskGroupController@show'  )->name('taskGroups.show');

Route::delete('tarefas-grupo/destroy/{taskGroup}', 'TaskGroupController@destroy')->name('taskGroups.destroy');

?>
