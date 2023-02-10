@extends('layout.index')

@section('title')
Danh sách vấn đề
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/commonPage.css') }}">
@endsection

@section('content')
<main>
  <div class="wrapper">
    <div class="content">
      @foreach ($vande as $vd)
      <a href="/{{$vd->tenkhongdau}}/{{$vd->id}}">
        <div class="content-item">
          <div class="image">
            <img src="img/legalpassion_logo.png" alt="asdasd">
          </div>
          <div class="post">
            <div class="post-intro">
              <p> <i>"Vấn đề"</i> </p>
            </div>
            <div class="post-title">
              <h4>{{ $vd->ten }}</h4>
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
    <div class="side-bar">
      <div class="tname">Lĩnh vực khác</div>
      <div class="table-of-contents">
        <div>
          @foreach ($loailinhvuc as $llv)
          <a href="/linhvuc/{{$llv->tenkhongdau}}/{{$llv->id}}">{{$llv->ten}}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</main>
@endsection