<?php
Route::get('/', function(){
    return view('site.home');
})->name('site.home');

Route::get('cursos', function(){
    return view('site.courses');
})->name('site.curses');

Route::get('contato', function(){
    return view('site.contact');
})->name('site.contact');
?>
