<h1>編集ページ</h1>
<form method="POST" action="{{route('post.update',['id' => $post->id])}}" enctype="multipart/form-data">
    @csrf
    {{-- タイトル --}}
    <div>
      <label for="title">タイトル</label>
      <input type="text" name="title" value="{{$post->title}}">
    </div>
    @error('title')
      {{$message}}
    @enderror

    {{-- 画像 --}}
    <div>
      <label for="image" accept="image/png,image/jpeg,image/jpg">ファイルを選択</label>
      <input type="file" name="image" value="{{$post->image}}">
    </div>
    @error('image')
      {{$message}}
    @enderror

    {{-- 詳細 --}}
    <div>
      <label for="description">詳細</label>
      <textarea name="description" rows="5">{{$post->description}} </textarea>
    </div>
    @error('description')
      {{$message}}
    @enderror

    <button type="submit">投稿を更新</button>

</form>