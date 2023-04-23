@extends('layouts.app')

@section('content')
<div class="container">
  <p class="mt-3 col-sm-4 col-lg-3 text-center d-inline-block fs-2 midashi">投稿編集</p>
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
      {{-- 登録画像の表示 --}}
      <div class="text-center">
        <img id="icon_img_prv" class="img-thumbnail w-100 mb-3"
            src="{{$post->image}}"style="max-width:35vw;">
      </div>
      {{-- 画像の更新用 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2" for="image" accept="image/png,image/jpeg,image/jpg">写真</label>
        <input class="ps-0 col-10" id="icon" type="file" name="image" value="{{$post->image}}" onchange="setImage">
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

<script>
  // アイコン画像プレビュー処理
  // 画像が選択される度に、この中の処理が走る
  $('#icon').on('change', function (ev) {
      // このFileReaderが画像を読み込む上で大切
      const reader = new FileReader();
      // ファイル名を取得
      const fileName = ev.target.files[0].name;
      // 画像が読み込まれた時の動作を記述
      reader.onload = function (ev) {
          $('#icon_img_prv').attr('src', ev.target.result);
      }
      reader.readAsDataURL(this.files[0]);
  })
</script>
@endsection