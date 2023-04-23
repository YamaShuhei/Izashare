@extends('layouts.app')

@section('content')
<div class="container bg-none">
  <div class="row">
    <div class="my-4">
      <p class="col-sm-3 col-lg-2 text-center d-inline-block fs-3 midashi"> 投稿一覧</p>
    </div>

  </div>
  {{-- 投稿分だけ繰り返す --}}
  <div class="row justify-content-center">
  @foreach($user as $u)
  
   <div class="card col-6 offset-1 border mb-2 shadow-sm" style="width: 23rem;">
      <a class="mt-2" href="{{route('post.show',['id' => $u->id])}}">
        @if($u->image)
          <img src="{{$u->image}}" alt="" style="height: 250px; width: 100%;">
        @else
          <img src="/images/noimage.jpg" alt="no image" style="height: 250px; width: 100%;">
        @endif
      </a>
      <div class="card-body">
        <a href="{{route('post.show',['id' => $u->id])}}" class="text-body fs-4">{{$u->name}}</a>
        <div class="fs-5"><i class="fa-regular fa-comment "></i> {{$u->comments->count();}}</div>
      </div>
    </div>
  @endforeach
  </div>

  <div class="d-flex justify-content-center">
    {{ $user->appends(request()->input())->links() }}
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