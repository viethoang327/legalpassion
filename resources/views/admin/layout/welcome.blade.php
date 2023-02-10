@extends('admin.layout.index')

@section('content')
<div class="main">
    <h1 class="main-title">Welcome to admin mamagement</h1>
    <div class="main-intro">
        <p>Đây là một trang quản lý được thiết kế để giúp bạn quản lý các chức năng của website của mình. Trên trang này, bạn có thể tìm thấy các liên kết đến các chức năng quản lý khác nhau, như quản lý người dùng, quản lý nội dung, và cấu hình hệ thống. Hãy chọn các liên kết từ thanh menu bên trái để bắt đầu sử dụng các chức năng của trang quản lý này.</p>
        <p>Thông tin tổng quan về trang web: </p>
        <!-- Thông tin lượt xem -->
         <!-- Thông tin tỉ lệ truy cập -->
         <div class="stats-item">
            <p class="stats-label">Tổng số bài viết</p>
            <p class="stats-value">{{$tongsobaiviet}}</p>
        </div>
        <div class="stats-item">
            <p class="stats-label">Tổng lượt xem</p>
            <p class="stats-value">{{$tongluotxem}}</p>
        </div>

        <!-- Thông tin tổng số người dùng -->
        <div class="stats-item">
            <p class="stats-label">Tổng số người dùng</p>
            <p class="stats-value">{{$tongnguoidung}}</p>
        </div>

        <!-- Thông tin lượng bình luận -->
        <div class="stats-item">
            <p class="stats-label">Lượng bình luận</p>
            <p class="stats-value">{{$tongbinhluan}}</p>
        </div>
        <p>Trên đây là những thông tin hữu ích mà bạn có thể sử dụng để theo dõi hiệu quả của trang web của mình và đưa ra các quyết định quản lý hợp lý</p>
    </div>
</div>
@endsection