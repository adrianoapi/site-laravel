<?php
Route::get('/',                    'QuestionController@index' )->name('questions.index');
Route::get('novo',                 'QuestionController@create')->name('questions.create');
Route::post('store',               'QuestionController@store' )->name('questions.store');
Route::get('editar/{question}',    'QuestionController@edit'  )->name('questions.edit');
Route::put('editar/{question}',    'QuestionController@update')->name('questions.update');
Route::put('confirmar/{question}', 'QuestionController@confirm')->name('questions.confirm');
Route::get('{question}',           'QuestionController@show'  )->name('questions.show');

Route::delete('destroy/{question}', 'QuestionController@destroy')->name('questions.destroy');
?>
