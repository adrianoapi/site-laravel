<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/blog/home', function(){
    return view('blog.home');
});

Route::view('/info', 'info');

Route::view('/form', 'upload.form');
Route::post('upload', 'UploadController@upload')->name('upload');

Route::get('/', function(){
    return view('site.home');
})->name('site.home');

Route::get('/cursos', function(){
    return view('site.courses');
})->name('site.curses');

Route::get('/contato', function(){
    return view('site.contact');
})->name('site.contact');

Route::get('/administracao', 'AuthController@dashboard')->name('admin');
Route::get('/administracao/login', 'AuthController@showLoginForm')->name('admin.login');
Route::get('/administracao/logout', 'AuthController@logout')->name('admin.logout');
Route::post('/administracao/login/do', 'AuthController@login')->name('admin.login.do');

Route::resource('artigos', 'PostController')->names('posts')->parameters(['artigos' => 'post']);

Route::resource('favoritos', 'LinkController')->names('links')->parameters(['favoritos' => 'link']);

Route::get('/usuario/{id}', 'UserController@show')->name('user.listUser');
Route::get('/usuario', 'UserController@show')->name('users.listAll');

Route::get('/endereco/novo', 'AddressController@create');
Route::post('/endereco/store', 'AddressController@store')->name('address.store');
Route::get('endereco/{address}', 'AddressController@show');

Route::get('/artigo/{post}', 'PostController@show');
Route::get('/categoria/{category}', 'CategoryController@show');
Route::get('/favorito/{link}', 'LinkController@show');

Route::get('/categoria/novo', 'CategoryController@create');
Route::post('/categoria/store', 'CategoryController@store')->name('category.store');

Route::resource('produtos', 'Form\\ProductController')->names('products')->parameters(['produtos' => 'product']);

Route::get('listagem', 'UserController@listUser');
Route::group(['namespace' => 'form'], function () {
    /**
     * GET 
     */
    Route::get('usuarios', 'TestController@listAllUsers')->name('users.listAll');
    Route::get('usuarios/novo', 'TestController@formAddUser')->name('users.formAddUser');
    Route::get('usuarios/editar/{user}', 'TestController@formEditUser')->name('users.formEditUser');
    Route::get('usuarios/{user}', 'TestController@listUser')->name('users.list');

    /**
     * PSOT
     */
    Route::post('usuarios/store', 'TestController@storeUser')->name('users.store');

    /**
     * PUT/PATCH
     */
    Route::put('usuarios/edit/{user}', 'TestController@edit')->name('users.edit');

    /**
     * DELETE
     */
    Route::delete('usuarios/destroy/{user}', 'TestController@destroy')->name('user.destroy');
});
