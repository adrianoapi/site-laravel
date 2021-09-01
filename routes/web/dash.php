<?php

Route::get ('/',           'DashController@index')->name('dash.index');
Route::get ('/ajax-chart', 'DashController@ajaxChart')->name('dash.ajaxChart');
Route::get ('/ajax-task',  'DashController@ajaxTask')->name('dash.ajaxTask');
Route::get ('/ajax-graph', 'DashController@graphPie')->name('dash.graphPie');

?>
