@extends('layout.index')

@section('title')
Thông tin cá nhân
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/nguoidung.css') }}">
@endsection

@section('content')
<main>
    <div class="profile-wrapper">
        <h1 class="profile-title">Thông tin cá nhân</h1>
        <div class="profile-card">
            <div class="profile-picture">
                <img src="img/hinhdaidien.png" alt="Ảnh đại diện">
            </div>
            <div class="profile-details">
                <ul class="profile-list">
                    <li>
                        <strong class="profile-label">Tên:</strong>
                        <span class="profile-value">{{Auth::user()->name}}</span>
                    </li>
                    <li>
                        <strong class="profile-label">Email:</strong>
                        <span class="profile-value">{{Auth::user()->email}}</span>
                    </li>
                    <li>
                        <strong class="profile-label">Số điện thoại:</strong>
                        <span class="profile-value">{{Auth::user()->phone}}</span>
                    </li>
                    <li>
                        <strong class="profile-label">Mật khẩu:</strong>
                        <span class="profile-value">********</span>
                    </li>
                </ul>
            </div>

        </div>
        <div>
            <a href="{{route('legalpassion.user.quanlynguoidung')}}">
            <button class="btn-edit">Sửa thông tin</button>
            </a>
        </div>
    </div>
</main>

@endsection