@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
<div class="my-4">
  <p class="col-6 col-lg-6 text-center d-inline-block fs-3 csv-midashi"> CSVインポート/エクスポート</p>
</div>

<div class="bg-white rounded shadow p-3">
  <form class="my-3" method="post" action="{{ route('csv.upload') }}" enctype="multipart/form-data">
    @csrf
    <label class="fs-4 ud-deco mb-3" name="csvFile">CSVインポート(投稿データ)</label><br>
    <input type="file" name="csvFile" class="mb-3" id="csvFile"/><br>
    <input class="btn btn-success" type="submit" value="インポート">
  </form>

  <form class="my-3" action="{{ route('csv.download') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label class="fs-4 ud-deco mb-3" name="csvexport">CSVエクスポート(投稿データ)</label><br>
    <button type="submit" class="btn btn-primary">エクスポート</button>
  </form>
</div>
</div>
@endsection