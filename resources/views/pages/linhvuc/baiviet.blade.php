@extends('layout.index')

@section('title')
Bài viết
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/baiviet.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                {{$err}}<br>
                @endforeach
            </div>
            @endif
            <h3>Bình luận</h3>
            <div class="loginToComment" style="
            <?php if (Auth::user()) {
                echo 'display: none';
            } ?>">
                <a href="{{route('legalpassion.user.login')}}"><strong>Đăng nhập</strong></a> để viết bình luận
            </div>
            @if(Auth::user())
            <form class="form-comment" action="comment/{{$baiviet['id']}}" method="POST">
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
                        <!-- <button class="like-btn">
                            <span>{{$cmt->like}}</span>
                            <i class="fa fa-thumbs-up"></i>
                            <span>Like</span>
                        </button>
                        <button class="dislike-btn">
                            <span>{{$cmt->dislike}}</span>
                            <i class="fa fa-thumbs-down"></i>
                            <span>Dislike</span>
                        </button> -->
                        <button class="show-comment">
                            <i class="fa fa-comments"></i>
                            <span>Hiển thị {{$cmt->replycomment->count()}} bình luận</span>
                        </button>
                    </div>
                    <!-- Add nested comments here -->
                    @foreach($cmt->replycomment as $replycmt)
                    <div class="nested-comments" style="display:none;">
                        <p class="comment-updated-at">{{$replycmt->updated_at}}</p>
                        <p class="comment-author">{{$replycmt->user->name}}</p>
                        <p class="comment-text">"{{$replycmt->noidung}}"</p>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
           
        </div>
    </div>
</main>
<!-- REPLY COMMENT-->
@if(Auth::user())
@if($comment->count() > 0)
<script>
    document.querySelectorAll('.reply-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            // create reply form
            var form = document.createElement('form');
            form.action = 'reply/{{$cmt->id}}';
            form.method = 'POST';
            form.classList.add('reply-form');

            var csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            var textarea = document.createElement('textarea');
            textarea.name = 'noidungcmt';
            textarea.rows = '5';
            textarea.placeholder = 'Viết phản hồi của bạn tại đây';
            form.appendChild(textarea);


            var button = document.createElement('button');
            button.type = 'submit';
            button.innerHTML = 'Gửi';
            form.appendChild(button);

            // add form to comment
            var comment = event.target.closest('.comment');
            if (comment.querySelector('form.reply-form')) {
                // if form already exists, remove it
                comment.removeChild(comment.querySelector('form.reply-form'));
            } else {
                // otherwise, add form
                comment.appendChild(form);
                form.classList.add('reply-form');
            }
        });
    });

    // add click event listener to document
    document.addEventListener('click', function(event) {
        // if click is outside of comment or comment child elements
        if (!event.target.closest('.comment') && !event.target.closest('.reply-form')) {
            // remove all reply forms
            document.querySelectorAll('.reply-form').forEach(function(form) {
                form.parentElement.removeChild(form);
            });
        }
    });
</script>

<!-- SHOW COMMENT -->
<script>
    const showCommentButtons = document.querySelectorAll('.show-comment');

    showCommentButtons.forEach(button => {
        button.addEventListener('click', () => {
            const nestedComments = button.parentNode.parentNode.querySelectorAll('.nested-comments');
            nestedComments.forEach(comment => {
                if (comment.style.display === 'none' || comment.style.display === '') {
                    comment.style.display = 'flex';
                    button.innerHTML = '<i class="fa fa-comments"></i> Ẩn bình luận';
                } else {
                    comment.style.display = 'none';
                    button.innerHTML = '<i class="fa fa-comments"></i> Hiển thị bình luận';
                }
            });
        });
    });
</script>
@endif
@endif
@endsection
@section('script')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.like-btn').click(function() {
        var commentId = $(this).data('comment-id');
        $.ajax({
            type: 'POST',
            url: "/comment/like",
            data: {
                'comment_id': commentId,
                '_token': '{{ csrf_token() }}'
            },
            success: function(data) {
                // Update the like count
                $('#comment-' + commentId + ' .like-btn span').text(data.likes);
            }
        });
    });

    $('.dislike-btn').click(function() {
        var commentId = $(this).data('comment-id');
        $.ajax({
            type: 'POST',
            url: "/comment/dislike",
            data: {
                'comment_id': commentId,
                '_token': '{{ csrf_token() }}'
            },
            success: function(data) {
                // Update the dislike count
                $('#comment-' + commentId + ' .dislike-btn span').text(data.dislikes);
            }
        });
    });
});
</script> -->
@endsection