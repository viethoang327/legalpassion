@extends('layout.index')

@section('title')
Đăng ký tài khoản
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/nguoidung.css') }}">
@endsection

@section('content')
<main>
    <div class="profile-wrapper">
        <h1 class="profile-title">Đăng ký tài khoản</h1>
        @if(count($errors) > 0)
        <div class="alert alert-danger" style="color:red">
            @foreach($errors->all() as $err)
            {{ $err }}<br>
            @endforeach
        </div>
        @endif
        @if(session('thongbao'))
        <div class="alert alert-success" style="color:green">
            {{ session('thongbao') }}
        </div>
        @endif
        <div class="profile-card">
            <div class="profile-card__avatar">
                <img src="upload/hinhdaidien/hinhdaidien.png" alt="DefaultPicture" width="200px">
            </div>
            <form action="/dangky" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tên của bạn</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
                </div>
                <div class="form-group">
                    <label for="password">Đổi mật khẩu</label>
                    <input type="password" class="form-control password" id="password" name="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="passwordAgain">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control password" id="passwordAgain" name="passwordAgain" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="hinhdaidien">Hình đại diện</label>
                    <input type="file" class="form-control" id="hinhdaidien" name="hinhdaidien" style="height:30px">
                    @if(session('loi'))
                    <span class="alert alert-danger" style="color:red">
                        {{ session('loi') }}
                    </span>
                    @endif
                    </span>
                </div>
                <div class="btn-section">
                    <button type="submit" class="btn-edit">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
