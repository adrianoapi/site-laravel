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

Route::get('/template', 'HomeController@index')->name("main");
Route::get('/minor', 'HomeController@minor')->name("minor");


Route::get('/blog/home', function(){
    return view('blog.home');
});

Route::view('/info', 'info');

Route::view('/form', 'upload.form');
Route::post('upload', 'UploadController@upload')->name('upload');

Route::prefix('dash')->group(__DIR__ . '/web/dash.php');

Route::get('/administracao', 'AuthController@dashboard')->name('admin');
Route::get('/administracao/login', 'AuthController@showLoginForm')->name('admin.login');
Route::get('/administracao/logout', 'AuthController@logout')->name('admin.logout');
Route::post('/administracao/login/do', 'AuthController@login')->name('admin.login.do');

Route::get('login', 'AuthController@showLoginForm')->name('login');

Route::resource('artigos', 'PostController')->names('posts')->parameters(['artigos' => 'post']);

Route::prefix('favoritos'          )->group(__DIR__ . '/web/links.php');
Route::prefix('diagramas'          )->group(__DIR__ . '/web/diagrams.php');
Route::prefix('favoritos-itens'    )->group(__DIR__ . '/web/linksItems.php');
Route::prefix('tarefas-grupo'      )->group(__DIR__ . '/web/taskGroups.php');
Route::prefix('tarefas'            )->group(__DIR__ . '/web/tasks.php');
Route::prefix('transacoes-tipo'    )->group(__DIR__ . '/web/transitionTypes.php');
Route::prefix('lancamentos-fixos'  )->group(__DIR__ . '/web/fixedCosts.php');
Route::prefix('lancamento-grupo'   )->group(__DIR__ . '/web/ledgerGroups.php');
Route::prefix('lancamentos'        )->group(__DIR__ . '/web/ledgerEntries.php');
Route::prefix('lancamento-itens'   )->group(__DIR__ . '/web/ledgerItems.php');
Route::prefix('grafico-financeiro' )->group(__DIR__ . '/web/financialCharts.php');
Route::prefix('exames'             )->group(__DIR__ . '/web/exams.php');
Route::prefix('questoes'           )->group(__DIR__ . '/web/questions.php');
Route::prefix('respostas'          )->group(__DIR__ . '/web/answers.php');
Route::prefix('imagens'            )->group(__DIR__ . '/web/questionImages.php');
Route::prefix('parcelamento-cartao')->group(__DIR__ . '/web/creditcards.php');
Route::prefix('colecoes'           )->group(__DIR__ . '/web/collections.php');
Route::prefix('colecoes/itens'     )->group(__DIR__ . '/web/collItems.php');
Route::prefix('senhas'             )->group(__DIR__ . '/web/passwords.php');
Route::prefix('colecoes/itens/img' )->group(__DIR__ . '/web/collItemImages.php');
Route::prefix('usuario'            )->group(__DIR__ . '/web/users.php');
Route::prefix('endereco'           )->group(__DIR__ . '/web/address.php');
Route::prefix('categoria'          )->group(__DIR__ . '/web/category.php');
Route::prefix('perfil'             )->group(__DIR__ . '/web/perfil.php');
Route::prefix('/site-old'          )->group(__DIR__ . '/web/site.php');

Route::prefix('/')->group(function(){
    Route::get('/', function(){
        return view('site3.home');
    })->name('site3.home');
});


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
