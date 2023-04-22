@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<form method="post" action="{{ route('csv.upload') }}" enctype="multipart/form-data">
  @csrf
  <label name="csvFile">csvファイル</label>
  <input type="file" name="csvFile" class="" id="csvFile"/>
  <input type="submit">
</form>
<input type="submit">
@endsection