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

Route::prefix('/')->group(function(){
    Route::get('/', function(){
        return view('site.home');
    })->name('site.home');
    
    Route::get('cursos', function(){
        return view('site.courses');
    })->name('site.curses');
    
    Route::get('contato', function(){
        return view('site.contact');
    })->name('site.contact');
});



Route::get('dash', 'DashController@index')->name('dash.index');

Route::get('/administracao', 'AuthController@dashboard')->name('admin');
Route::get('/administracao/login', 'AuthController@showLoginForm')->name('admin.login');
Route::get('/administracao/logout', 'AuthController@logout')->name('admin.logout');
Route::post('/administracao/login/do', 'AuthController@login')->name('admin.login.do');

Route::get('login', 'AuthController@showLoginForm')->name('login');

Route::resource('artigos', 'PostController')->names('posts')->parameters(['artigos' => 'post']);

Route::prefix('favoritos')->group(function(){
    Route::get ('/',             'LinkController@listAllLinks')->name('links.listAll');
    Route::get ('novo',          'LinkController@create'      )->name('links.create');
    Route::get ('editar/{link}', 'LinkController@formEditLink')->name('links.formEditLink');
    Route::get ('{link}',        'LinkController@listLink'    )->name('links.list');
    Route::post('store',         'LinkController@store'       )->name('links.store');
    Route::put ('edit/{link}',   'LinkController@edit'        )->name('links.edit');

    Route::delete('destroy/{link}', 'LinkController@destroy')->name('links.destroy');
});

Route::prefix('favoritos-itens')->group(function(){
    Route::get ('/',                 'LinkItemController@listAllLinksItems')->name('linksItems.listAll');
    Route::get ('novo',              'LinkItemController@create'           )->name('linksItems.create');
    Route::post('store',             'LinkItemController@store'            )->name('linksItems.store');
    Route::put ('edit/{linkItem}',   'LinkItemController@edit'             )->name('linksItems.edit');
    Route::get ('{linkItem}',        'LinkItemController@list'             )->name('linksItems.list');
    Route::get ('editar/{linkItem}', 'LinkItemController@formEditLink'     )->name('linksItems.formEditLink');
    
    Route::delete('destroy/{linkItem}', 'LinkItemController@destroy')->name('linksItems.destroy');
});

Route::prefix('tarefas-grupo')->group(function(){
    Route::get ('/',                  'TaskGroupController@index' )->name('taskGroups.index');
    Route::get ('novo',               'TaskGroupController@create')->name('taskGroups.create');
    Route::post('store',              'TaskGroupController@store' )->name('taskGroups.store');
    Route::get ('editar/{taskGroup}', 'TaskGroupController@edit'  )->name('taskGroups.edit');
    Route::put ('edit/{taskGroup}',   'TaskGroupController@update')->name('taskGroups.update');
    Route::get ('{taskGroup}',        'TaskGroupController@show'  )->name('taskGroups.show');
    
    Route::delete('tarefas-grupo/destroy/{taskGroup}', 'TaskGroupController@destroy')->name('taskGroups.destroy');
});

Route::prefix('tarefas')->group(function(){
    Route::get ('/',             'TaskController@index' )->name('tasks.index');
    Route::get ('novo',          'TaskController@create')->name('tasks.create');
    Route::post('store',         'TaskController@store' )->name('tasks.store');
    Route::get ('editar/{task}', 'TaskController@edit'  )->name('tasks.edit');
    Route::put ('editar/{task}', 'TaskController@update')->name('tasks.update');
    Route::get ('{task}',        'TaskController@show'  )->name('tasks.show');

    Route::delete('destroy/{task}', 'TaskController@destroy')->name('tasks.destroy');
});

Route::prefix('transacoes-tipo')->group(function(){
    Route::get ('/',                       'TransitionTypeController@index' )->name('transitionTypes.index');
    Route::get ('novo',                    'TransitionTypeController@create')->name('transitionTypes.create');
    Route::post('store',                   'TransitionTypeController@store' )->name('transitionTypes.store');
    Route::get ('editar/{transitionType}', 'TransitionTypeController@edit'  )->name('transitionTypes.edit');
    Route::put ('editar/{transitionType}', 'TransitionTypeController@update')->name('transitionTypes.update');
    Route::get ('{transitionType}',        'TransitionTypeController@show'  )->name('transitionTypes.show');
   
    Route::delete('destroy/{transitionType}', 'TransitionTypeController@destroy')->name('transitionTypes.destroy');
});

Route::prefix('lancamento-grupo')->group(function(){
    Route::get ('/',                    'LedgerGroupController@index' )->name('ledgerGroups.index');
    Route::get ('novo',                 'LedgerGroupController@create')->name('ledgerGroups.create');
    Route::post('store',                'LedgerGroupController@store' )->name('ledgerGroups.store');
    Route::get ('editar/{ledgerGroup}', 'LedgerGroupController@edit'  )->name('ledgerGroups.edit');
    Route::put ('editar/{ledgerGroup}', 'LedgerGroupController@update')->name('ledgerGroups.update');
    Route::get ('{ledgerGroup}',        'LedgerGroupController@show'  )->name('ledgerGroups.show');

    Route::delete('destroy/{ledgerGroup}', 'LedgerGroupController@destroy')->name('ledgerGroups.destroy');
});

Route::prefix('lancamentos')->group(function(){
    Route::get ('/',                    'LedgerEntryController@index' )->name('ledgerEntries.index');
    Route::get ('novo',                 'LedgerEntryController@create')->name('ledgerEntries.create');
    Route::post('store',                'LedgerEntryController@store' )->name('ledgerEntries.store');
    Route::get ('editar/{ledgerEntry}', 'LedgerEntryController@edit'  )->name('ledgerEntries.edit');
    Route::put ('editar/{ledgerEntry}', 'LedgerEntryController@update')->name('ledgerEntries.update');
    Route::get ('{ledgerEntry}',        'LedgerEntryController@show'  )->name('ledgerEntries.show');

    Route::delete('destroy/{ledgerEntry}', 'LedgerEntryController@destroy')->name('ledgerEntries.destroy');
});

Route::prefix('lancamento-itens')->group(function(){
    Route::get ('/',                   'LedgerItemController@index' )->name('ledgerItems.index');
    Route::get ('novo/{ledgerEntry}',  'LedgerItemController@create')->name('ledgerItems.create');
    Route::post('store',               'LedgerItemController@store' )->name('ledgerItems.store');
    Route::get ('editar/{ledgerItem}', 'LedgerItemController@edit'  )->name('ledgerItems.edit');
    Route::put ('editar/{ledgerItem}', 'LedgerItemController@update')->name('ledgerItems.update');
    Route::get ('{ledgerEntry}',       'LedgerItemController@show'  )->name('ledgerItems.show');
    
    Route::delete('destroy/{ledgerItem}','LedgerItemController@destroy')->name('ledgerItems.destroy');
});

Route::prefix('exames')->group(function(){
    Route::get ('/',             'ExamController@index' )->name('exams.index');
    Route::get ('novo',          'ExamController@create')->name('exams.create');
    Route::post('store',         'ExamController@store' )->name('exams.store');
    Route::get ('editar/{exam}', 'ExamController@edit'  )->name('exams.edit');
    Route::put ('editar/{exam}', 'ExamController@update')->name('exams.update');
    Route::get ('{exam}',        'ExamController@show'  )->name('exams.show');

    Route::delete('destroy/{exam}', 'ExamController@destroy')->name('exams.destroy');
});

Route::prefix('questoes')->group(function(){
    Route::get('/',                 'QuestionController@index' )->name('questions.index');
    Route::get('novo',              'QuestionController@create')->name('questions.create');
    Route::post('store',            'QuestionController@store' )->name('questions.store');
    Route::get('editar/{question}', 'QuestionController@edit'  )->name('questions.edit');
    Route::put('editar/{question}', 'QuestionController@update')->name('questions.update');
    Route::get('{question}',        'QuestionController@show'  )->name('questions.show');

    Route::delete('destroy/{question}', 'QuestionController@destroy')->name('questions.destroy');
});

Route::prefix('respostas')->group(function(){
    Route::get ('/',             'AnswerController@index' )->name('answers.index');
    Route::get ('novo',          'AnswerController@create')->name('answers.create');
    Route::post('store',         'AnswerController@store' )->name('answers.store');
    Route::get ('edit/{answer}', 'AnswerController@edit'  )->name('answers.edit');
    Route::put ('edit/{answer}', 'AnswerController@update')->name('answers.update');
    Route::get ('{answer}',      'AnswerController@show'  )->name('answers.show');

    Route::delete('destroy/{answer}', 'AnswerController@destroy')->name('answers.destroy');
});

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

    Route::get('usuarios',               'TestController@listAllUsers')->name('users.listAll');
    Route::get('usuarios/novo',          'TestController@formAddUser' )->name('users.formAddUser');
    Route::get('usuarios/editar/{user}', 'TestController@formEditUser')->name('users.formEditUser');
    Route::get('usuarios/{user}',        'TestController@listUser'    )->name('users.list');
    Route::post('usuarios/store',        'TestController@storeUser'   )->name('users.store'); # POST
    Route::put('usuarios/edit/{user}',   'TestController@edit'        )->name('users.edit'); # PUT/PATCH

    Route::delete('usuarios/destroy/{user}', 'TestController@destroy')->name('user.destroy');
});