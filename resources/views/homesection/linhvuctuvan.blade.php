<section id="linhvuc" class="title">
        <div class="container">
            <div>
                <div>
                    <h2>
                        <span>
                            LĨNH VỰC TƯ VẤN
                        </span>
                    </h2>
                </div>
            </div>
            <div class="title__categories">
                <div class="title__categories--item">
                    @foreach ($loailinhvuc as $linhvuc)
                    <div class="field">
                        <a href="/linhvuc/{{$linhvuc->tenkhongdau}}/{{$linhvuc->id}}">
                        <img class="img-field" src="upload/linhvuc/{{$linhvuc->hinhanh}}" alt="{{$linhvuc->hinhanh}}">
                        <h2>
                            <a href="/linhvuc/{{$linhvuc->tenkhongdau}}/{{$linhvuc->id}}"">{{$linhvuc->ten}}</a>
                        </h2>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>