{{-- 管理者用 --}}
@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container bg-none">
  <div class="row">
    <div class="my-4">
      <span class="col-sm-3 col-lg-2 text-center d-inline-block fs-3 midashi"> 投稿一覧</span>
    </div>
    {{-- 検索フォーム --}}
    <div>
      <form class="input-group" method="GET" action="{{ route('adminpost.index') }}">
        <input class="form-control" type="search" placeholder="店舗名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <button class="btn btn-secondary" type="submit">検索</button>
            <button class="btn btn-secondary">
                <a href="{{ route('adminpost.index') }}" class="text-white text-decoration-none">
                    クリア
                </a>
            </button>
    </form>
    </div>

  </div>

  {{-- テーブルで表示 --}}
  <table class="table table-light table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">画像</th>
      <th scope="col">タイトル</th>
      <th scope="col">投稿者</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  {{-- 投稿分だけ繰り返す --}}
  @foreach($post as $p)
  <tr>
    <td>{{$p->id}}</td>
    <td>
          @if($p->image)
           <img src="{{$p->image}}" alt="" style="max-height: 50px; max-width: 50px;">
          @else
            <img src="/images/no_image.jpg" alt="no image" style="max-height: 50px; max-width: 50px;">
          @endif
    </td>
    <td>{{$p->title}}</td>
    <td>{{$p->user->name}}</td>
    <td>
      <form class="mt-2 px-0 d-inline-block" method="POST" action="{{route('adminpost.destroy',['id'=>$p->id])}}">
        @csrf
        <input type="submit"  class="btn btn-danger" name="delete" value="削除" onClick="delete_alert(event);return false;">
      </form>
    </td>

  </tr>
  @endforeach
  </tbody>
  </table>

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