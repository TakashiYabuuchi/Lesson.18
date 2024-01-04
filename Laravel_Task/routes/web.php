<!-- ルーティング -->
<?php

use Illuminate\Support\Facades\Route;

// use宣言追加（PostsController）
use App\Http\Controllers\PostsController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('hello', function () {
//     echo 'Hello';
// });

// アクセス時のルーティング
Route::get('/',[PostsController::class,'index']);

// index（投稿一覧画面）へのルーティング
Route::get('index',[PostsController::class,'index']);

// createForm（新規投稿画面）へのルーティング
Route::get('/create-form',[PostsController::class,'createForm']);

// create（新規投稿処理）へのルーティング
Route::post('/post/create',[PostsController::class,'create']);

// updateForm（投稿編集画面）へのルーティング
Route::post('/post/update-form',[PostsController::class,'updateForm']);

// update（投稿編集処理）へのルーティング
Route::post('/post/update',[PostsController::class,'update']);

// delete（投稿削除処理へのルーティング）
Route::post('/post/delete',[PostsController::class,'delete']);

// search（検索処理へのルーティング）
Route::post('/index',[PostsController::class,'search']);

// 認証機能へのルーティング
Auth::routes(['register']);
