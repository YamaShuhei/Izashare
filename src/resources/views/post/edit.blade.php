@extends('layouts.app')

@section('content')
<div class="container">
  <p class="fs-1">投稿編集</p>
  <form class="p-3 bg-light border rounded shadow-sm" method="POST" action="{{route('post.update',['id' => $post->id])}}" enctype="multipart/form-data">
      @csrf
      {{-- 店舗名 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2 d-inline-block" for="title">店舗名</label>
        <div class="ps-0 col-10">
          <input type="text" name="title" value="{{$post->title}}">
        </div>
      </div>
      @error('title')
        {{$message}}
      @enderror

      {{-- 画像 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2" for="image" accept="image/png,image/jpeg,image/jpg">写真</label>
        <input class="ps-0 col-10" type="file" name="image" value="{{$post->image}}">
      </div>
      @error('image')
        {{$message}}
      @enderror

      {{-- 詳細 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2" for="description">レビュー</label>
        <textarea  class="ps-0 col-8" name="description" rows="5">{{$post->description}} </textarea>
      </div>
      @error('description')
        {{$message}}
      @enderror
      <div class="text-end">
        <button class="btn btn-primary" type="submit">投稿を更新</button>
        <a class="btn btn-secondary" href="{{route('post.index')}}">戻る</a>
      </div>
  </form>
</div>
@endsection