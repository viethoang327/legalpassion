@extends('layout.index')

@section('title')
Kết quả tìm kiếm
@endsection

@section('CSS')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/danhsach.css') }}">

@endsection

@section('content')
<main class="container">
    <div class="col">
        <div class="col-left">
            @php
            function changeColor($str, $tukhoa){
            return str_replace($tukhoa, "<span style='color:red;font-style:italic'>$tukhoa</span>", $str);
            }
            @endphp
            <h1 class="search-title">Tìm kiếm: {{$tukhoa}}  </h1>
            <h3 class="search-result">Có {{$count}} kết quả:</h3>
            @foreach($danhsachketqua as $baiviet)
            <div class="col-left__item">        
                <div class="col-left__item--img">
                    <a href="/linhvuc/baiviet/{{$baiviet->tieudekhongdau}}/{{$baiviet->id}}"><img src="/upload/baiviet/{{$baiviet->hinhanh}}" alt="{{$baiviet->hinhanh}}"></a>
                </div>
                <div class="col-left__item--text">
                    <a href="/linhvuc/baiviet/{{$baiviet->tieudekhongdau}}/{{$baiviet->id}}">
                        <h3>{!! changeColor($baiviet->tieude,$tukhoa) !!}</h3>
                        <p>{!! changeColor($baiviet->tomtat,$tukhoa) !!}</p>
                    </a>
                </div>
            </div>
            @endforeach
            
           <!-- PAGINATION -->
           <div class="pagination">
                @if ($danhsachketqua->currentPage() > 1)
                <a href="{{ route('legalpassion.search')}}?page={{ $danhsachketqua->currentPage() - 1 }}" class="previous" data-page="{{ $danhsachketqua->currentPage() - 1 }}">&laquo; Previous</a>
                @endif

                @for ($i = 1; $i <= $danhsachketqua->lastPage(); $i++)
                    <a href="{{ route('legalpassion.search')}}?page={{ $i }}" class="number {{ ($danhsachketqua->currentPage() == $i) ? 'active' : '' }}" data-page="{{ $i }}">{{ $i }}</a>
                    @endfor


                @if ($danhsachketqua->currentPage() < $danhsachketqua->lastPage())
                    <a href="{{ route('legalpassion.search') }}?page={{ $danhsachketqua->currentPage() + 1 }}" class="next" data-page="{{ $danhsachketqua->currentPage() + 1 }}">Next &raquo;</a>
                @endif

            </div>
        </div>
        <div class="col-right">
            <div class="category">
                <span>
                    Bài viết khác
                </span>
            </div>
            @foreach($randomThuTuc as $post)
            <div class="col-right__item">
                <div class="col-right__item--img">
                    <img src="/upload/thutuc/{{$post->hinhanh}}" alt="img">
                </div>
                <div class="col-right__item--text">
                    <a href="/thutuc/{{$post->tieudekhongdau}}/{{$post->id}}">
                        <p>
                            {!!$post->tomtat!!}
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
        let keyword = '{{ $tukhoa }}';

        $.ajax({
            type: 'GET',
            url: '/timkiem',
            data: {
                page: page,
                keyword: keyword
            },
            success: function(data) {
                $('.danhsachketqua').html(data);
            }
        });
    });
</script>
@endsection