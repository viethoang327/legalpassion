@extends('layout.index')
@section('title')
Trang chủ
@endsection
@section('content')
<main>
    <!-- SLIDE -->
    @include('homesection.slide')

    <!-- LÝ DO CHỌN LEGAL PASSION -->
    @include('homesection.gioithieu')
    
    <!-- SHORTCUT Lĩnh vực tư vấn -->
    @include('homesection.linhvuctuvan')

    <!-- SHORTCUT BÀI VIẾT NỔI BẬT -->
    @include('homesection.baivietnoibat')

    <!-- SHORTCUT BẢN TIN -->
    @include('homesection.bantin')
    
</main>
@endsection