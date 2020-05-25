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

Route::get('dash', 'DashController@index')->name('dash.index');

Route::get('/administracao', 'AuthController@dashboard')->name('admin');
Route::get('/administracao/login', 'AuthController@showLoginForm')->name('admin.login');
Route::get('/administracao/logout', 'AuthController@logout')->name('admin.logout');
Route::post('/administracao/login/do', 'AuthController@login')->name('admin.login.do');

Route::resource('artigos', 'PostController')->names('posts')->parameters(['artigos' => 'post']);

Route::get('favoritos', 'LinkController@listAllLinks')->name('links.listAll');
Route::get('favoritos/novo', 'LinkController@create')->name('links.create');
Route::get('favoritos/editar/{link}', 'LinkController@formEditLink')->name('links.formEditLink');
Route::get('favoritos/{link}', 'LinkController@listLink')->name('links.list');
Route::post('favoritos/store', 'LinkController@store')->name('links.store');
Route::put('favoritos/edit/{link}', 'LinkController@edit')->name('links.edit');
Route::delete('favoritos/destroy/{link}', 'LinkController@destroy')->name('links.destroy');

Route::get('favoritos-itens', 'LinkItemController@listAllLinksItems')->name('linksItems.listAll');
Route::get('favoritos-itens/novo', 'LinkItemController@create')->name('linksItems.create');
Route::post('favoritos-itens/store', 'LinkItemController@store')->name('linksItems.store');
Route::put('favoritos-itens/edit/{linkItem}', 'LinkItemController@edit')->name('linksItems.edit');
Route::get('favoritos-itens/{linkItem}', 'LinkItemController@list')->name('linksItems.list');
Route::get('favoritos-itens/editar/{linkItem}', 'LinkItemController@formEditLink')->name('linksItems.formEditLink');
Route::delete('favoritos-itens/destroy/{linkItem}', 'LinkItemController@destroy')->name('linksItems.destroy');

Route::get('tarefas-grupo', 'GroupTaskController@index')->name('groupTasks.index');
Route::get('tarefas-grupo/novo', 'GroupTaskController@create')->name('groupTasks.create');
Route::post('tarefas-grupo/store', 'GroupTaskController@store')->name('groupTasks.store');
Route::get('tarefas-grupo/editar/{groupTask}', 'GroupTaskController@edit')->name('groupTasks.edit');
Route::put('tarefas-grupo/edit/{groupTask}', 'GroupTaskController@update')->name('groupTasks.update');
Route::get('tarefas-grupo/{groupTask}', 'GroupTaskController@show')->name('groupTasks.show');
Route::delete('tarefas-grupo/destroy/{groupTask}', 'GroupTaskController@destroy')->name('groupTasks.destroy');

Route::get('tarefas', 'TaskController@index')->name('tasks.index');
Route::get('tarefas/novo', 'TaskController@create')->name('tasks.create');
Route::post('tarefas/store', 'TaskController@store')->name('tasks.store');
Route::get('tarefas/editar/{task}', 'TaskController@edit')->name('tasks.edit');
Route::put('tarefas/editar/{task}', 'TaskController@update')->name('tasks.update');
Route::get('tarefas/{task}', 'TaskController@show')->name('tasks.show');
Route::delete('tarefas/destroy/{task}')->name('tasks.destroy');

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
