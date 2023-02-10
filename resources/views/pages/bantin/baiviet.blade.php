@extends('layout.index')

@section('title')
Tin Tức
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/baiviet.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col">
        <h6><a href="{{route('legalpassion.home.tintuc')}}">Bản tin</a></h6>
        <h1 class="post-title">{{$baiviettintuc['tieude']}}</h1>
        <div class="updated-at">
            <span class="posted on">Post on {{$baiviettintuc['updated_at']}} by Admin</span>
        </div>
        <div class="post-picture">
            <img src="upload/tintuc/{{$baiviettintuc['hinhanh']}}" alt="{{$baiviettintuc['hinhanh']}}">
        </div>
        <div class="post-content">
            <p>{!!$baiviettintuc['noidung']!!}</p>
        </div>
        <div class="post-footer">
            <div class="post-footer__item">
                <div class="post-footer__item--img">
                    Cần tư vấn xin liên hệ
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="post-footer__item--text">
                    <p>Điện thoại: 0972 465 532</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection