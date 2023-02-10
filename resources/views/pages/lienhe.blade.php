@extends('layout.index')

@section('title')
Liên hệ
@endsection
@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lienhe.css') }}">
@endsection
@section('content')
<div class="container">
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
    <form id="contact" action="/lienhe" method="POST">
        @csrf
        <h3>Liên hệ với chúng tôi</h3>
        <h4>Liên hệ ngay và nhận trả lời trong vòng 24h!</h4>
        <fieldset>
            <input placeholder="Tên của bạn" name="name" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <input placeholder="Email" type="email" name="email" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Số điện thoại" name="phone" type="tel" tabindex="3" required>
        </fieldset>
        <fieldset>
            <textarea placeholder="Thông điệp cho chúng tôi...." name="message" tabindex="4" required></textarea>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Gửi</button>
        </fieldset>
    </form>

</div>
@endsection
@section('script')
@endsection