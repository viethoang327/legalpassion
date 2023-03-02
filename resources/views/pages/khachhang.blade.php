@extends('layout.index')

@section('title')
Danh sách khách hàng
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/danhsach.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col">
        <div class="col-left">
            @foreach($danhsachkhachhang as $khachhang)
            <div class="col-left__item">
                <div class="col-left__item--img">
                    <img src="/upload/khachhang/{{$khachhang->hinhanh}}" alt="{{$khachhang->hinhanh}}">
                </div>
                <div class="col-left__item--text">
                    <h3>{{$khachhang->ten}}</h3>
                    <p>{!! $khachhang->noidung !!}</p>
                </div>
            </div>
            @endforeach
            <!-- PAGINATION -->
            <div class="pagination">
                @if ($danhsachkhachhang->currentPage() > 1)
                <a href="{{ route('legalpassion.home.khachhang') }}?page={{ $danhsachkhachhang->currentPage() - 1 }}" class="previous" data-page="{{ $danhsachkhachhang->currentPage() - 1 }}">« Previous</a>
                @endif

                @for ($i = 1; $i <= $danhsachkhachhang->lastPage(); $i++)
                    <a href="{{ route('legalpassion.home.khachhang') }}?page={{ $i }}" class="number {{ ($danhsachkhachhang->currentPage() == $i) ? 'active' : '' }}" data-page="{{ $i }}">{{ $i }}</a>
                    @endfor

                    @if ($danhsachkhachhang->currentPage() < $danhsachkhachhang->lastPage())
                        <a href="{{ route('legalpassion.home.khachhang') }}?page={{ $danhsachkhachhang->currentPage() + 1 }}" class="next" data-page="{{ $danhsachkhachhang->currentPage() + 1 }}">Next &raquo;</a>
                        @endif
            </div>

        </div>
        <div class="col-right">
            <div class="category">
                <span>
                    Bài viết nổi bật
                </span>
            </div>
            @foreach($baivietnoibat as $post)
            <div class="col-right__item">
                <div class="col-right__item--img">
                    <img src="/upload/baiviet/{{$post->hinhanh}}" alt="img">
                </div>
                <div class="col-right__item--text">
                    <a href="linhvuc/baiviet/{{$post->id}}/{{$post->tieudekhongdau}}.html">
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