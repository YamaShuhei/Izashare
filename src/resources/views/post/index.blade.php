@extends('layouts.app')

@section('content')
  <h1>投稿一覧</h1>
  {{-- 投稿分だけ繰り返す --}}
  @foreach($post as $p)

    {{-- 投稿ユーザーとuser_idが一致する時に編集へのリンク表示 --}}
    @if($p->user_id == Auth::id())
      <a href="{{route('post.edit',['id' => $p->id])}}">編集</a>
    @endif

    <h1>タイトル</h1>
    <p>{{$p->title}}</p>
    <h2>画像<h2>
    <p><img src="../../uploads/{{$p->image}}"alt="" style="width: 200"></p>
    <h2>投稿詳細</h2>
    <p>{{$p->description}}</p>
    <hr>

  @endforeach