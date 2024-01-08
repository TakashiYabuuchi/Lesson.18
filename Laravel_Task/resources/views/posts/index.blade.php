<!-- 投稿一覧画面 -->
@extends('layouts.app')

@section('content')
<div class='container'>
<!-- 投稿フォーム画面へのリンク -->
<p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

<!-- 検索フォーム -->
<div id="search">
  {!! Form::open(['url' => '/index']) !!}
  {!! Form::input('text', 'postSearch', null, ['placeholder' => '投稿検索']) !!}
  <!-- 検索ボタン -->
  <button type="submit" name="search" class="fas fa-search">検索</button>
  {!! Form::close() !!}
</div>
<br>

<h2 class='page-header'>投稿一覧</h2>
<!-- 投稿一覧表示エリア -->
<table class='table table-hover'>
<tr>
<th>名前</th>
<th>投稿内容</th>
<th>投稿日時</th>
<th></th>
<th></th>
</tr>

@foreach ($lists as $list)
<tr>
<td>{{ $list->user_name}}</td>
<td>{{ $list->contents }}</td>
<td>{{ $list->updated_at }}</td>

<!-- ログインユーザーが投稿したものに、更新・削除ボタンを表示 -->
@if($list->user_name==\Auth::user()->name)
<!-- 更新ボタン -->
<td><a class="btn btn-primary" href="/post/{{$list->id}}/update-form">更新</a></td>

<!-- 削除ボタン -->
<td>
  {!! Form::open(['url' => '/post/delete']) !!}
  {!! Form::hidden('id', $list->id) !!}
  <button type="submit" class="btn btn-primary" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</button>
  {!! Form::close() !!}
</td>
@else
<td></td>
<td></td>
@endif
</tr>

<!-- 検索時のエラーメッセージ表示 -->
@endforeach
</table>
@if ($lists->isEmpty()&&!empty($all))
検索結果は0件です。
@endif

</div>
@endsection
