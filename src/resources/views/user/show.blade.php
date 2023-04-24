@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mt-3 ">
    <p class="col-4 col-lg-3 text-center d-inline-block fs-3 my-midashi">マイページ</p>
  </div>
  <div class="p-2 border rounded shadow-sm bg-light">
        @csrf
        {{-- タイトル/画像 --}}
        <div class="row">
          <div class="col-12">
              <div class="ps-3 pb-3 fw-bold fs-2 ps-0 col-8"><span class="fs-4 fw-normal">ユーザー名「</span>{{$user->name}}<span class="fs-4 normal">」</span>
                {{-- 投稿ユーザーとuser_idが一致する時に編集/削除へのリンク表示 --}}
                @if($user->id == Auth::id())
                  <a class="btn btn-success" href="{{route('user.edit',['id' => $user->id])}}">編集</a>
                @endif
              </div>
          </div>

        {{-- 詳細 --}}
        <div class="mb-2 p-3 py-2" style="height:150px;">
            <div class="ps-0 fs-4 ud-deco">ユーザ情報</div>
            <div>メールアドレス：{{$user->email}}</div>
            <div>登録日時：{{$user->created_at}}</div>
        </div>
       </div> 

  </div>

  
  <div class="my-4">
    <p class="col-sm-3 col-lg-2 text-center d-inline-block fs-3 midashi"> 投稿一覧</p>
  </div>


  <div class="p-2 border rounded shadow-sm bg-light">
    @csrf
  {{-- 投稿画像一覧 --}}
  <div class="row justify-content-center">
    @foreach($posts as $p)
    
     <div class="card col-6 offset-1 border mb-2 shadow-sm" style="width: 23rem;">
        <a class="mt-2" href="{{route('post.show',['id' => $p->id])}}">
          @if($p->image)
            <img src="{{$p->image}}" alt="" style="height: 250px; width: 100%;">
          @else
            <img src="/images/noimage.jpg" alt="no image" style="height: 250px; width: 100%;">
          @endif
        </a>
        <div class="card-body">
          <a href="{{route('post.show',['id' => $p->id])}}" class="text-body fs-4">{{$p->title}}</a>
          <div class="fs-5"><i class="fa-regular fa-comment "></i> {{$p->comments->count();}}</div>
        </div>
      </div>
    @endforeach
    </div>

  </div>

</div>

@endsection

