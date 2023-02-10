@extends('layout.index')

@section('title')
Chỉnh sửa thông tin cá nhân
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/nguoidung.css') }}">
@endsection

@section('content')
<main>
    <div class="profile-wrapper">
        <h1 class="profile-title">Chỉnh sửa thông tin cá nhân</h1>
        @if(count($errors) > 0)
        <span class="alert alert-danger" style="color:red">
            @foreach($errors->all() as $err)
            {{ $err }}<br>
            @endforeach
        </span>
        @endif
        @if(session('thongbao'))
        <span class="alert alert-success" style="color:green">
            {{ session('thongbao') }}
        </span>
        @endif
        <div class="profile-card">
            <div class="profile-card__avatar">
                <img src="upload/hinhdaidien/{{Auth::user()->hinhdaidien}}" alt="{{Auth::user()->hinhdaidien}}" width="200px">
            </div>
            <form action="/quanlynguoidung" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tên của bạn</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" readonly>
                </div>
                <div class="form-changepassword">
                    <input type="checkbox" name="changepassword" id="changepassword"> Đổi mật khẩu
                </div>
                <div class="form-group">
                    <label for="password">Đổi mật khẩu</label>
                    <input type="password" class="form-control password" id="password" name="password" placeholder="Nhập mật khẩu" disabled="">
                </div>
                <div class="form-group">
                    <label for="passwordAgain">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control password" id="passwordAgain" name="passwordAgain" placeholder="Nhập lại mật khẩu" disabled="">
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
                    <button type="submit" class="btn-edit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#changepassword").change(function() {
            if ($(this).is(":checked")) {
                $(".password").removeAttr('disabled');

            } else {
                $(".password").attr('disabled', '');
            }
        });
    });
</script>
@endsection