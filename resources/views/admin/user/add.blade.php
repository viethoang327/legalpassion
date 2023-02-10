@extends('admin.layout.index')

@section('content')
<div class="main">
    <h1 class="main-title">Thêm thành viên</h1>
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

    <div class="main-content">
        <form action="/admin/thanhvien/themthanhvien" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên thành viên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên thành viên">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            </div>
            <div class="form-group">
                <label for="passwordAgain">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="Nhập lại mật khẩu">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-checkbox">
                <label for="level">Cấp bậc</label>
                <input class="form-control-checkbox" type="radio" name="level" value="0" checked=""> Thường
                <input class="form-control-checkbox" type="radio" name="level" value="1"> Admin
            </div>
            <div class="form-group">
                <label for="hinhdaidien">Hình đại diện</label>
                <input type="file" class="form-control" id="hinhdaidien" name="hinhdaidien" style="height:30px;width:540px;">
                @if(session('loi'))
                <span class="alert alert-danger" style="color:red">
                    {{ session('loi') }}
                </span>
                @endif
            </div>
            <div class="btn-section">
                <button type="submit" class="btn btn-primary">Thêm</button>
                <button type="reset" class="btn btn-reset">Làm mới</button>
            </div>
        </form>
    </div>
</div>
@endsection