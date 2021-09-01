<?php
Route::get ('/',             'ExamController@index' )->name('exams.index');
Route::get ('novo',          'ExamController@create')->name('exams.create');
Route::post('store',         'ExamController@store' )->name('exams.store');
Route::get ('editar/{exam}', 'ExamController@edit'  )->name('exams.edit');
Route::put ('editar/{exam}', 'ExamController@update')->name('exams.update');
Route::get ('teste/{exam}',  'ExamController@execute')->name('exams.execute');
Route::get ('{exam}',        'ExamController@show'  )->name('exams.show');

Route::delete('destroy/{exam}', 'ExamController@destroy')->name('exams.destroy');
?>
