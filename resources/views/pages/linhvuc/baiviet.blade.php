@extends('layout.index')

@section('title')
Bài viết
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/baiviet.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col">
        <h6><a href="{{route('legalpassion.home.linhvuc')}}">Lĩnh vực > Bài viết</a></h6>
        <h1 class="post-title">{{$baiviet['tieude']}}</h1>
        <div class="updated-at">
            <span class="posted on">Post on {{$baiviet['updated_at']}} by Admin</span>
        </div>
        <div class="post-picture">
            <img src="upload/baiviet/{{$baiviet['hinhanh']}}" alt="{{$baiviet['hinhanh']}}">
        </div>
        <div class="post-content">
            <p>{!!$baiviet['noidung']!!}</p>
        </div>
        <div class="post-footer">
            <div class="post-footer__item">
                <div class="post-footer__item--img">
                    Cần tư vấn xin liên hệ
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="post-footer__item--text">
                    <p>Điện thoại: 0972 465 532</p>
                </div>
            </div>
        </div>
        <div class="post-comment">
            @if(session('thongbao'))
            <div class="alert .alert-disappear">
                {{session('thongbao')}}
            </div>
            @endif
            <h3>Bình luận</h3>

            @if(Auth::user())
            <form action="comment/{{$baiviet['id']}}" method="POST">
                @csrf
                <textarea name="noidungcmt" rows="5" placeholder="Viết bình luận của bạn tại đây"></textarea>
                <button type="submit">Gửi</button>
            </form>
            @endif
            <div class="comments-list">
                @foreach($comment as $cmt)
                <div class="comment">
                    <p class="comment-updated-at">{{$cmt->updated_at}}</p>
                    <p class="comment-author">{{$cmt->user->name}}</p>
                    <p class="comment-text">"{{$cmt->noidung}}"</p>
                    <div class="comment-reaction">
                        <button class="reply-btn">Trả lời</button>
                        <button class="like-btn">
                            <i class="fa fa-thumbs-up"></i>
                            <span>Like</span>
                        </button>
                        <button class="dislike-btn">
                            <i class="fa fa-thumbs-down"></i>
                            <span>Dislike</span>
                        </button>

                    </div>
                    <!-- Add nested comments here -->
                </div>
                @endforeach
                <!-- Add more comments here -->
            </div>
        </div>
    </div>
</main>
<script>
    const alert = document.querySelector('.alert-disappear');
    setTimeout(function() {
        alert.style.display = "none";
    }, 3000);
</script>
@endsection