@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mt-3 ">
    <p class="col-sm-3 col-lg-2 text-center d-inline-block fs-3 midashi">投稿詳細</p>
  </div>
  <div class="p-2 border rounded shadow-sm bg-light">
        @csrf
        {{-- タイトル/画像 --}}
        <div class="row">
          <div class="col-12">
              <div class="ps-3 pb-3 fw-bold fs-2 ps-0 col-8"><span class="fs-4 fw-normal">店舗名「</span>{{$post->title}}<span class="fs-4 normal">」</span>
                {{-- 投稿ユーザーとuser_idが一致する時に編集/削除へのリンク表示 --}}
                @if($post->user_id == Auth::id())
                <a class="btn btn-success" href="{{route('post.edit',['id' => $post->id])}}">編集</a>
                <form class="mt-2 px-0 d-inline-block" method="POST" action="{{route('post.destroy',['id'=>$post->id])}}">
                  @csrf
                  <input type="submit"  class="btn btn-danger" name="delete" value="削除" onClick="delete_alert(event);return false;">
                </form>
                @endif
              </div>
          </div>
          {{-- 画像表示部分 --}}
          <div class="bg-dark p-0">
            <div class="mx-auto col-6">
              @if($post->image)
                <img src="{{$post->image}}" alt="" style="height: 100%; width: 100%;">
              @else
                <img src="/images/noimage.jpg" alt="no image" style="height: 100%; width: 100%;">
              @endif
            </div>
          </div>
        </div>
        <hr class="mt-0 mb-1">

        {{-- 詳細 --}}
        <div class="mb-2 p-3 py-2" style="height:150px;">
            <div class="ps-0 fs-4 ud-deco">店舗紹介文</div>
            <div>{{$post->description}}</div>
        </div> 

        {{-- 投稿日時 --}}
        <div class="px-2">
          <p class="text-end mb-0">{{$post->created_at}}</p>
        </div>
  </div> 

  <div class="mt-3 mb-5 bg-white rounded shadow">
    <p class="mt-3 col-sm-3 col-lg-2 text-center d-inline-block fs-3 midashi-comment">コメント</p>
      <ul class="p-0">
        <ol class="p-0">

          {{-- コメントフォーム --}}
          <form method="POST" action="{{route('comments.store',$post)}}">
            @csrf
            <input type="text" class="mx-auto mb-2 form form-control shadow-sm border border-3" name="body" style="width:70%;" placeholder="コメントを入力してください">
            <div class="text-end">
              <button class="btn btn-secondary mb-3" style="position:relative;right:12vw;"><i class="fa-regular fa-comment-dots fa-lg"></i> コメントする</button>
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
            <div class="row justify-content-center">
            <div class="col-6 arrow_box mb-4 ">
                <ol class="text-white text-start p-0">{{$comment->body}}</ol>
                <ol class="p-0 text-white text-end">{{$comment->created_at}} </ol>
            </div>
            @if($post->user_id == Auth::id())
                <div class="col-2 d-flex align-items-center justify-content-center mb-3">
                    <form method="post" action="{{route('comments.destroy',$comment)}}">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-lg btn-danger">削除</button>
                    </form>
                </div>
            @endif
            </div>
        @endforeach

      </ul>
  </div>
</div>

<script>

function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
   }
   document.deleteform.submit();
};
    </script>

@endsection

