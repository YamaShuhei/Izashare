@extends('layouts.app')

@section('content')
<div class="container bg-none">
  <div class="row">
    <div class="my-4">
      <span class="bg-white fs-2 p-2 rounded"><i class="fa-solid fa-beer-mug-empty" style="color: #ffbf0f;"></i> 投稿一覧</span>
    </div>
    {{-- 検索フォーム --}}
    <div>
      <form class="input-group" method="GET" action="{{ route('post.index') }}">
        <input class="form-control" type="search" placeholder="店舗名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <button class="btn btn-secondary" type="submit">検索</button>
            <button class="btn btn-secondary">
                <a href="{{ route('post.index') }}" class="text-white text-decoration-none">
                    クリア
                </a>
            </button>
    </form>
    </div>

  </div>
  {{-- 投稿分だけ繰り返す --}}
  @foreach($post as $p)
   <div class="card border p-2 mb-2 shadow-sm">
    <div class="row">
      <div class="col-2">
        <a href="{{route('post.show',['id' => $p->id])}}">
          @if($p->image)
           <img src="{{$p->image}}" alt="" style="max-height: 150px; width: 100%;">
          @else
            <img src="/images/no_image.jpg" alt="no image">
          @endif
        </a>
      </div>
      <div class="col-10">
        <a href="{{route('post.show',['id' => $p->id])}}" class="fs-3">{{$p->title}}</a>
        <div class="row">
          <div>詳細：{{$p->description}}</div>
          <div>投稿者：{{$p->user->name}}</div> 
        </div>
      </div>
    </div>

    </div>


  @endforeach
  <div class="d-flex justify-content-center">
    {{ $post->appends(request()->input())->links() }}
  </div>
</div>
@endsection

<script>
  function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
   }
   document.deleteform.submit();
  };
</script>