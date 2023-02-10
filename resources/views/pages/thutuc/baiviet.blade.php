@extends('layout.index')

@section('title')
Thủ tục
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/baiviet.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col">
        <h6><a href="{{route('legalpassion.home.thutuc')}}">Thủ tục</a></h6>
        <h1 class="post-title">{{$baivietthutuc['tieude']}}</h1>
        <div class="updated-at">
            <span class="posted on">Post on {{$baivietthutuc['updated_at']}} by Admin</span>
        </div>
        <div class="post-picture">
            <img src="upload/thutuc/{{$baivietthutuc['hinhanh']}}" alt="{{$baivietthutuc['hinhanh']}}">
        </div>
        <div class="post-content">
            <p>{!!$baivietthutuc['noidung']!!}</p>
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