@extends('layout.index')

@section('title')
Danh sách tin tức
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/danhsach.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col">
        <div class="col-left">
            @foreach($danhsachtintuc as $baiviet)
            <div class="col-left__item">
                <div class="col-left__item--img">
                    <a href="tintuc/{{$baiviet->id}}/{{$baiviet->tieudekhongdau}}.html"><img src="/upload/tintuc/{{$baiviet->hinhanh}}" alt="{{$baiviet->hinhanh}}"></a>
                </div>
                <div class="col-left__item--text">
                    <a href="tintuc/{{$baiviet->id}}/{{$baiviet->tieudekhongdau}}.html">
                        <h3>{{$baiviet->tieude}}</h3>
                        <p>{!! $baiviet->tomtat !!}</p>
                    </a>
                </div>
            </div>
            @endforeach
            <!-- PAGINATION -->
            <div class="pagination">
                @if ($danhsachtintuc->currentPage() > 1)
                <a href="{{ route('legalpassion.home.tintuc') }}?page={{ $danhsachtintuc->currentPage() - 1 }}" class="previous" data-page="{{ $danhsachtintuc->currentPage() - 1 }}">« Previous</a>
                @endif

                @for ($i = 1; $i <= $danhsachtintuc->lastPage(); $i++)
                    <a href="{{ route('legalpassion.home.tintuc') }}?page={{ $i }}" class="number {{ ($danhsachtintuc->currentPage() == $i) ? 'active' : '' }}" data-page="{{ $i }}">{{ $i }}</a>
                @endfor

                @if ($danhsachtintuc->currentPage() < $danhsachtintuc->lastPage())
                    <a href="{{ route('legalpassion.home.tintuc') }}?page={{ $danhsachtintuc->currentPage() + 1 }}" class="next" data-page="{{ $danhsachtintuc->currentPage() + 1 }}">Next &raquo;</a>
                 @endif
            </div>

        </div>
        <div class="col-right">
            <div class="category">
                <span>
                    Bài viết khác
                </span>
            </div>
            @foreach($randomTinTuc as $post)
            <div class="col-right__item">
                <div class="col-right__item--img">
                    <img src="/upload/tintuc/{{$post->hinhanh}}" alt="img">
                </div>
                <div class="col-right__item--text">
                    <a href="tintuc/{{$post->id}}/{{$post->tieudekhongdau}}.html">
                        <p>
                        {!!$post->tieude!!}
                        </p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.pagination .number').click(function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            $.ajax({
                type: 'get',
                url: "{{ route('legalpassion.home.thutuc') }}",
                data: {
                    page: page
                },
                success: function(data) {
                    $('.thutuc').html(data);
                }
            });
        });
        $('.pagination .previous').click(function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            $.ajax({
                type: 'get',
                url: "{{ route('legalpassion.home.thutuc') }}",
                data: {
                    page: page
                },
                success: function(data) {
                    $('.thutuc').html(data);
                }
            });
        });
        $('.pagination .next').click(function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            $.ajax({
                type: 'get',
                url: "{{ route('legalpassion.home.thutuc') }}",
                data: {
                    page: page
                },
                success: function(data) {
                    $('.thutuc').html(data);
                }
            });
        });
    });
</script>

@endsection