@extends('layouts.app')

@section('content')
<div class="container">
  <p class="fs-1">新規登録</p>
  <form class="p-3 bg-light border rounded shadow-sm" method="POST" action="{{route('post.store')}}" enctype="multipart/form-data" accept-charset="UTF-8">
      @csrf
      {{-- タイトル入力 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2 d-inline-block" for="title">店舗名</label>
        <div class="ps-0 col-10">
          <input type="text" name="title" value="{{old("title")}}">
        </div>
      </div>
        {{-- バリデーションメッセージ --}}
        @error('title')
          {{$message}}
        @enderror

      {{-- 詳細 --}}
      <div class="row mb-2">
      <label class="fw-bold col-2" for="image" accept="image/png,image/jpeg,image/jpg">写真</label>
      <input class="ps-0 col-10" type="file" name="image" value="{{old("image")}}">
      </div>
      @error('image')
        {{$message}}
      @enderror

      <div class="row mb-2">
      <label class="fw-bold col-2" for="description">レビュー</label>
      <textarea class="ps-0 col-8" name="description" rows="5">{{old('description')}}</textarea>
      </div>
      @error('description')
        {{$message}}
      @enderror
        <div class="text-end">
          <button class="btn btn-primary" type="submit">投稿する</button>
          <a class="btn btn-secondary" href="{{route('post.index')}}">投稿一覧へ</a>  </form>
        </div>
</div>
@endsection
