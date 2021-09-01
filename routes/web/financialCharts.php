<?php
Route::get ('/ajax-dynamic', 'FinancialChartController@graphDynamic')->name('financialCharts.dynamic');
Route::get('/', 'FinancialChartController@index')->name('financialCharts.index');
Route::get ('/ajax-fixed-coast',  'FinancialChartController@fixedCoastAjax')->name('financialCharts.fixedCoastAjax');
?>
