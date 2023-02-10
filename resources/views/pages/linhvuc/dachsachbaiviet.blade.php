@extends('layout.index')

@section('title')
Danh sách bài viết
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/danhsach.css') }}">
@endsection

@section('content')
<main class="container">
    <div class="col">
        <div class="col-left">
            @foreach($danhsachbaiviet as $baiviet)
            <div class="col-left__item">
                <div class="col-left__item--img">
                    <a href="linhvuc/baiviet/{{$baiviet->id}}/{{$baiviet->tieudekhongdau}}.html"><img src="/upload/baiviet/{{$baiviet->hinhanh}}" alt="{{$baiviet->hinhanh}}"></a>
                </div>
                <div class="col-left__item--text">
                    <a href="linhvuc/baiviet/{{$baiviet->id}}/{{$baiviet->tieudekhongdau}}.html">
                        <h3>{{$baiviet->tieude}}</h3>
                        <p>{!! $baiviet->tomtat !!}</p>
                    </a>
                </div>
            </div>
            @endforeach
            <!-- PAGINATION -->
            <div class="pagination">
                @if ($danhsachbaiviet->currentPage() > 1)
                <a href="{{ route('legalpassion.home.linhvuc.danhsachbaiviet', ['tenkhongdau' => $tenkhongdau, 'id' => $id]) }}?page={{ $danhsachbaiviet->currentPage() - 1 }}" class="previous" data-page="{{ $danhsachbaiviet->currentPage() - 1 }}">&laquo; Previous</a>
                @endif

                @for ($i = 1; $i <= $danhsachbaiviet->lastPage(); $i++)
                    <a href="{{ route('legalpassion.home.linhvuc.danhsachbaiviet', ['tenkhongdau' => $tenkhongdau, 'id' => $id]) }}?page={{ $i }}" class="number {{ ($danhsachbaiviet->currentPage() == $i) ? 'active' : '' }}" data-page="{{ $i }}">{{ $i }}</a>
                    @endfor


                @if ($danhsachbaiviet->currentPage() < $danhsachbaiviet->lastPage())
                    <a href="{{ route('legalpassion.home.linhvuc.danhsachbaiviet', ['tenkhongdau' => $tenkhongdau, 'id' => $id]) }}?page={{ $danhsachbaiviet->currentPage() + 1 }}" class="next" data-page="{{ $danhsachbaiviet->currentPage() + 1 }}">Next &raquo;</a>
                @endif

            </div>

        </div>
        <div class="col-right">
            <div class="category">
                <span>
                    Bài viết khác
                </span>
            </div>
            @foreach($randomPost as $post)
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
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        let page = $(this).attr('href').split('page=')[1];
        let id = '{{ $id }}';

        $.ajax({
            type: 'GET',
            url: '/{{ $tenkhongdau }}/' + id,
            data: {
                page: page
            },
            success: function(data) {
                $('.danhsachbaiviet').html(data);
            }
        });
    });
</script>
@endsection