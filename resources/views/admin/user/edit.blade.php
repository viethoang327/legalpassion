@extends('admin.layout.index')

@section('content')
<div class="main">
    <h1 class="main-title">Sửa thành viên</h1>
    <h3 style="text-align: center;">{{$user -> name}}</h3>
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
        <form action="/admin/thanhvien/suathanhvien/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên thành viên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>
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
            <div class="form-checkbox">
                <label for="level">Cấp bậc</label>
                <input class="form-control-checkbox" type="radio" name="level" value="0" @if($user->level == 0)
                {{"checked"}}
                @endif
                > Thường
                <input class="form-control-checkbox" type="radio" name="level" value="1" @if($user->level == 1)
                {{"checked"}}
                @endif
                > Admin
            </div>
            <div class="form-group">
                <label for="hinhdaidien">Hình ảnh</label>
                <p>
                    <img src="upload/hinhdaidien/{{$user->hinhdaidien}}" alt="{{$user->hinhdaidien}}" width="150px">
                </p>
                <input type="file" class="form-control" id="hinhdaidien" name="hinhdaidien" style="height:30px;width:540px;">
                @if(session('loi'))
                <span class="alert alert-danger" style="color:red">
                    {{ session('loi') }}
                </span>
                @endif
                </span>
            </div>
            <div class="btn-section">
                <button type="submit" class="btn btn-primary">Sửa</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
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