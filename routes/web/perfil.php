<?php
Route::get('/', 'PerfilController@index')->name('perfil.index');
Route::get('sair', 'PerfilController@logout')->name('perfil.logout');
Route::put ('editar', 'PerfilController@update')->name('perfil.update');
?>
