@extends('layouts.app')

@section('content')
<div class="container">
  <p class="mt-3 col-sm-4 col-lg-3 text-center d-inline-block fs-2 midashi">新規登録</p>
  <form class="p-3 bg-light border rounded shadow-sm" method="POST" action="{{route('post.store')}}" enctype="multipart/form-data" accept-charset="UTF-8">
      @csrf
      {{-- タイトル入力 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2 d-inline-block" for="title">店舗名</label>
        <div class="ps-0 col-10">
          <input class="form-control w-75" type="text" name="title" value="{{old("title")}}">
        </div>
      </div>
        {{-- バリデーションメッセージ --}}
        @error('title')
          {{$message}}
        @enderror

      {{-- 画像 --}}
      {{-- 投稿画像 --}}
      <div class="row mb-2">
        <label class="fw-bold col-2" for="image" accept="image/png,image/jpeg,image/jpg">写真</label>
        <input class="ps-0 col-10" id="icon" type="file" name="image" value="{{old("image")}}" onchange="setImage">
      </div>
      {{-- プレビュー表示 --}}
      <div class="text-center">
        <img id="icon_img_prv" class="img-thumbnail w-100 mb-3"
            src='/images/noimage.jpg' style="max-width:35vw;">
      </div>
      @error('image')
        {{$message}}
      @enderror

      {{-- 店舗紹介文 --}}
      <div class="row mb-2">
      <label class="fw-bold col-2" for="description">店舗紹介文</label>
      <textarea class="ps-0 col-8 form-control w-75" name="description" rows="5">{{old('description')}}</textarea>
      </div>
      @error('description')
        {{$message}}
      @enderror

        {{-- 投稿/戻るボタン --}}
        <div class="text-center">
          <button class="btn btn-primary" type="submit">　　　<i class="fa-solid fa-paper-plane"></i> 投稿する　　　</button>
          <a class="btn btn-secondary" href="{{route('post.index')}}"><i class="fa-solid fa-left-long"></i> 投稿一覧へ</a>  </form>
        </div>
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