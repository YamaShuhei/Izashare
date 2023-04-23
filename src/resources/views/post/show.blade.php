@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <p class="col-3 fs-1">投稿詳細</p>
    {{-- 投稿ユーザーとuser_idが一致する時に編集/削除へのリンク表示 --}}
    @if($post->user_id == Auth::id())
      <div class="col-1 p-0 mt-2">
        <a class="btn btn-success" href="{{route('post.edit',['id' => $post->id])}}">編集</a>
      </div>
      <form class="col-1 mt-2 px-0" method="POST" action="{{route('post.destroy',['id'=>$post->id])}}">
        @csrf
        <input type="submit"  class="btn btn-danger" name="delete" value="削除" onclick="confirmDelete()">
      </form>
    @endif
  </div>
  <div class="border rounded shadow-sm bg-light">
        @csrf
        {{-- タイトル/画像 --}}
        <div class="row">
          <div class="col-2">
            <img src="../../uploads/{{$post->image}}" class=" rounded-start scol-10 " alt="image cap"  style="height:140px; width:100%;">
          </div>
          <div class="ps-0 col-9 d-flex align-items-center">
            <div class="fw-bold fs-3 ps-0 col-8"><span class="fs-4 fw-normal">店舗名</span><br>{{$post->title}}</div>
          </div>
        </div>
        <hr class="mt-0 mb-1">

        {{-- 詳細 --}}
        <div class="row mb-2 p-3 py-2" style="height:200px;">
            <div class="ps-0"><span class="fs-4">レビュー：</span>{{$post->description}} </div>
        </div> 

        {{-- 投稿日時 --}}
        <div class="px-2">
          <p class="text-end mb-0">{{$post->created_at}}</p>
        </div>
  </div> 
  <div>
    <p class="col-5 fs-1">コメント</p>
      <ul class="p-0">
        <ol class="p-0">

          {{-- コメントフォーム --}}
          <form method="POST" action="{{route('comments.store',$post)}}">
            @csrf
            <input type="text" class="mb-2 form form-control shadow-sm" name="body" placeholder="コメントを入力してください">
            <div class="text-end">
              <button class="btn btn-secondary">コメントする</button>
            </div>
            @error('body')
              {{$message}}
            @enderror
          </form>
        </ol>
      </ul>
      <ul class="p-0">
        
        {{-- コメント表示部分 --}}
        @foreach($post->comments()->latest()->get() as $comment)
            <div class="row">
            <div class="col-9 p-2 border rounded-top shadow bg-primary col-5 mb-3">
                <ol class="text-white p-0">{{$comment->body}}</ol>
                <ol class="p-0 text-white text-end">{{$comment->created_at}} </ol>
            </div>
            @if($post->user_id == Auth::id())
                <div class="col-2 d-flex align-items-center mb-3">
                    <form method="post" action="{{route('comments.destroy',$comment)}}">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">削除</button>
                    </form>
                </div>
            @endif
            </div>
        @endforeach

      </ul>
  </div>
</div>
@endsection

<script>
  function confirmDelete() {
    if (confirm("本当に削除しますか？")) {
      // OKがクリックされた場合の処理
      // ここに削除処理などを記述します
    } else {
      // キャンセルがクリックされた場合の処理
    }
  }
  </script>