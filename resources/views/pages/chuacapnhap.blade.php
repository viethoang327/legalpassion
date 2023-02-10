@extends('layout.index')

@section('title')
Chưa cập nhật
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/gioithieu.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col-left">
        <h6><a href="{{route('legalpassion.home')}}">Quay lại</a></h6>
        <h1 class="post-title" style="text-align:center"></h1>
        <div class="post-picture">
            <img src="img/buildingbackground.jpg" alt="buildingbackground" width="700px">
        </div>
        <div class="post-content">
            <p><strong>Nội dung chưa cập nhập. Trang web sẽ tiến hành cập nhập trong tương lai</strong></p>
        </div>
        <div class="post-footer">
            <div class="post-footer__title">
                Cần tư vấn xin liên hệ               
            </div>
            <div class="post-footer__text">               
                <p><i class="fa-solid fa-phone"></i> Điện thoại: 0972 465 532</p>
            </div>
        </div>
    </div>
    <div class="col-right">
        <!-- 20% -->
        <div class="side-banner">
            <img src="" alt="">
        </div>
    </div>
</main>
@endsection