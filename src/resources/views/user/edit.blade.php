@extends('layouts.app')

@section('content')
<div class="container">
  <p class="mt-3 col-sm-7 col-lg-4 text-center d-inline-block fs-2 my-midashi">ユーザー情報編集</p>
  <form class="p-3 bg-light border rounded shadow-sm" method="POST" action="{{route('user.update',['id' => $user->id])}}" enctype="multipart/form-data">
      @csrf
      {{-- ユーザー名 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2 d-inline-block" for="name">ユーザー名</label>
        <div class="ps-0 col-10">
          <input class="form-control w-50" type="text" name="name" value="{{$user->name}}">
        </div>
      </div>
      @error('name')
        {{$message}}
      @enderror

      {{-- メールアドレス --}}
      <div class="row mb-2">
        <label class="fw-bold col-2" for="email">Email</label>
        <input type="text"  class="col-8 form-control w-50" name="email" value="{{$user->email}}">
      </div>
      @error('email')
        {{$message}}
      @enderror

      {{-- 編集確定/戻るボタン --}}
      <div class="text-end">
        <button class="btn btn-primary" type="submit">ユーザ情報を更新</button>
        <a class="btn btn-secondary" href="{{route('user.show',['id' => $user->id])}}">戻る</a>
      </div>
  </form>
</div>

@endsection