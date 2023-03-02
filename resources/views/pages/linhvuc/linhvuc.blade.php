@extends('layout.index')

@section('title')
Danh sách lĩnh vực
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/commonPage.css') }}">
@endsection

@section('content')
<main>
  <div class="wrapper">
    <div class="content">
      @foreach ($loailinhvuc as $llv)
      <a href="/linhvuc/{{$llv->tenkhongdau}}/{{$llv->id}}">
        <div class="content-item">
          <div class="image">
            <img src="upload/linhvuc/{{$llv->hinhanh}}" alt="asdasd">
          </div>
          <div class="post">
            <div class="post-title">
              <h4>{{ $llv->ten }}</h4>
            </div>
            <div class="post-intro">
              <p><i>{!!$llv->mota!!}</i></p>
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
    <div class="side-bar">
    </div>
  </div>
</main>
@endsection