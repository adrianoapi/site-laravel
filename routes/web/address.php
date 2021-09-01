<?php
Route::get('/endereco/novo', 'AddressController@create');
Route::post('/endereco/store', 'AddressController@store')->name('address.store');
Route::get('endereco/{address}', 'AddressController@show');
?>
