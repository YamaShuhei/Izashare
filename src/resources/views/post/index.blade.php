<div class="container">
  <h1>投稿一覧</h1>
  @foreach($post as $p)
    <div class="bg-dark">
    <h1>タイトル</h1>
    <p>{{$p->title}}</p>
    <h2>画像<h2>
    <p><img src="../../uploads/{{$p->image}}"alt="" height="100px"></p>
    <h2>投稿詳細</h2>
    <p>{{$p->description}}</p>
    </div>
  @endforeach
</div>