<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use宣言追加（データベース）
use Illuminate\Support\Facades\DB;

// use宣言追加（認証機能）
use Illuminate\Support\Facades\Auth;

// use app\Models\User;



class PostsController extends Controller
{

    //indexメソッド（投稿一覧画面表示）
    public function index()
    {
    $list=DB::table('posts')->get();// データベースからpostsテーブルのデータを取得
    return view('posts.index',['lists'=>$list]);// ビューファイルindex.blade.php呼び出し
    }


    // searchメソッド（検索処理）
    public function search(Request $request)
    {
    $keyword=$request->input('postSearch');// 検索フォームに入力されたデータ取得
    $list=DB::table('posts');// データベースのpostsテーブルを指定
    if(!empty($keyword) && !mb_ereg_match("^(\s|　)+$", $keyword)) {// 検索フォームに入力されている場合
    $list->where('contents', 'LIKE', "%{$keyword}%");// 入力されたワードに完全もしくは部分一致したデータを検索
    }
    $all=DB::table('posts');// データベースのpostsテーブルを指定（postsテーブルにデータが1つでも入っていることの確認のため）
    $list = $list->get();// 検索したデータを取得
    return view('posts.index', ['lists'=>$list],['all'=>$all]);// ビューファイルindex.blade.php呼び出し
    }


    // createFormメソッド（新規投稿画面表示）
    public function createForm()
    {
    return view ('posts.createForm');// ビューファイルcreateForm.blade.php呼び出し
    }


    // createメソッド（新規投稿処理）
    public function create(Request $request)
    {
    $user=\Auth::user()->name;// ログインしているユーザーのユーザー名を取得
    $post=$request->input('newPost');// 投稿フォームに入力されたデータ取得
    // バリデーション（空白のみでの投稿不可・文字数100字まで）
    $validated=$request->validate([
        'newPost'=>'nospace|string|max:100'
        ],
        [// エラーメッセージ
        'newPost.nospace'=>'空白のみでの投稿はできません。',
        'newPost.string'=>'空白のみでの投稿はできません。',
        'newPost.max'=>'投稿可能なメッセージは100文字までです。'
        ]);
    // postsテーブルにユーザー名と投稿内容を登録
    DB::table('posts')->insert([
    'user_name'=>$user,
    'contents'=>$post
    ]);
    return redirect('/index');// /indexへ遷移
    }


    // updateFormメソッド（投稿編集画面表示）
    public function updateForm($id)
    {
    //更新したい投稿のIDを受け取り、投稿内容を取得
    $post=DB::table('posts')
    ->where('id',$id)
    ->first();
    return view('posts.updateForm',['post'=>$post]);// ビューファイルupdateForm.blade.php呼び出し
    }


    // updateメソッド（投稿編集処理）
    public function update(Request $request)
    {
    // ユーザーIDと更新内容を取得
    $id=$request->input('id');
    $up_post=$request->input('upPost');
    // バリデーション（空白のみでの投稿不可・文字数100字まで）
    $validated=$request->validate([
    'upPost'=>'nospace|string|max:100'
    ],
    [// エラーメッセージ
    'upPost.nospace'=>'空白のみでの投稿はできません。',
    'upPost.string'=>'空白のみでの投稿はできません。',
    'upPost.max'=>'投稿可能なメッセージは100文字までです。'
    ]);
    // postsテーブルの投稿内容を更新
    DB::table('posts')
    ->where('id',$id)
    ->update(
    ['contents'=>$up_post]
    );
    return redirect('/index');// /indexへ遷移
    }


    // deleteメソッド（投稿削除処理）
    public function delete(Request $request)
    {
    // 削除したい投稿のIDを受け取り、投稿内容を削除
    $id=$request->input('id');
    DB::table('posts')
    ->where('id',$id)
    ->delete();
    return redirect('/index');// /indexへ遷移
    }


    // 認証機能追加
    public function __construct()
    {
    $this->middleware('auth');
    }





}
