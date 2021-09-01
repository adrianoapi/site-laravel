<?php
Route::get ('/',               'AnswerController@index' )->name('answers.index');
Route::get ('novo/{question}', 'AnswerController@create')->name('answers.create');
Route::post('store',           'AnswerController@store' )->name('answers.store');
Route::get ('edit/{answer}',   'AnswerController@edit'  )->name('answers.edit');
Route::put ('edit/{answer}',   'AnswerController@update')->name('answers.update');
Route::get ('{question}',      'AnswerController@show'  )->name('answers.show');

Route::delete('destroy/{answer}', 'AnswerController@destroy')->name('answers.destroy');
?>
