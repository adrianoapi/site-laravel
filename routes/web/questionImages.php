<?php
Route::get ('novo/{question}',  'QuestionImageController@create')->name('questionImages.create');
Route::post('store',            'QuestionImageController@store' )->name('questionImages.store');

Route::delete('destroy/{questionImage}', 'QuestionImageController@destroy' )->name('questionImages.destroy');
?>
