<h1>新規登録</h1>
<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
    @csrf
    {{-- タイトル入力 --}}
    <div>
     <label for="title">タイトル</label>
     <input type="text" name="title" value="{{old("title")}}">
    </div>
      {{-- バリデーションメッセージ --}}
      @error('title')
        {{$message}}
      @enderror

    {{-- 詳細 --}}
    <div>
     <label for="image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
     <input type="file" name="image" value="{{old("image")}}">
    </div>
     @error('image')
      {{$message}}
     @enderror

    <div>
     <label for="description">詳細</label>
     <textarea name="description" rows="5">{{old('description')}}</textarea>
    </div>
    @error('description')
      {{$message}}
    @enderror

        <button type="submit">投稿する</button>
</form>