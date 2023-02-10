@extends('layout.index')

@section('title')
Đăng nhập
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/userLogin.css') }}">
@endsection

@section('content')
<main>
<div class="wrapper">
        <form role="form" action="dangnhap" method="POST">
            @csrf
            <div class="login">
                <h2 id="txt">Đăng nhập</h2>
                @if(count($errors) > 0)
                    <div class="alert alert-disappear" style="color:red">
                        @foreach($errors->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </div>
                @endif
                @if(session('thongbao'))
                    <div class="alert alert-disappear" style="color:red">
                        {{ session('thongbao') }}
                    </div>
                @endif
                <div class="inputBox">
                    <input type="text" placeholder="Email" name="email">
                </div>
    
                <div class="inputBox">
                    <input type="password" name="password" placeholder="Mật khẩu">
                </div>
    
                <div class="inputBox">
                    <input type="submit" value="Đăng nhập" id="btn">
                </div>
    
                <div class="group">
                    <a href="#">Quên mật khẩu</a>
                    <a href="{{route('legalpassion.user.dangky')}}">Đăng kí</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection