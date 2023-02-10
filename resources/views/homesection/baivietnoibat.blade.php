<section id="thutuc" class="title">
    <div class="container">
        <div>
            <div>
                <h2>
                    <span>
                        BÀI VIẾT NỔI BẬT
                    </span>
                </h2>
            </div>
        </div>
        <div class="title-guide">
            <div class="title-guide__row">
                @foreach ($baivietnoibat as $item)
                <div class="title-guide__row-item">
                    <a href="thutuc/{{$item->id}}/{{$item->tieudekhongdau}}.html">
                        <div class="title-guide__row--box">
                            <div class="image-box">
                                <img src="/upload/baiviet/{{$item->hinhanh}}" alt="{{$item->hinhanh}}">
                            </div>
                            <div class="text-box">
                                <h5>
                                    {{$item->tieude}}
                                </h5>
                                <div class="date">{{date("d",strtotime($item->updated_at))." tháng ".date("m, Y"),strtotime($item->updated_at)}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>