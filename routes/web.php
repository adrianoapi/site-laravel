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

Route::get('/template', 'HomeController@index'    )->name("main");
Route::get('/minor', 'HomeController@minor'       )->name("minor");
Route::get('login', 'AuthController@showLoginForm')->name('login');

Route::prefix('dash'               )->group(__DIR__ . '/web/dash.php');
Route::prefix('administracao'      )->group(__DIR__ . '/web/admin.php');
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
Route::prefix('usuarios'           )->group(__DIR__ . '/web/users.php');
Route::prefix('perfil'             )->group(__DIR__ . '/web/perfil.php');
Route::prefix('/'                  )->group(__DIR__ . '/web/site3.php');
Route::prefix('/site-old'          )->group(__DIR__ . '/web/site.php');

Route::resource('artigos', 'PostController')->names('posts')->parameters(['artigos' => 'post']);
