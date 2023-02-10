<li><a href="{{ route('legalpassion.home.linhvuc')}}" class="menu">Lĩnh vực tư vấn</a>
    <ul class="subMenu">
        @foreach ($loailinhvuc as $llv)
        <li><a href="/linhvuc/{{$llv->tenkhongdau}}/{{$llv->id}}">{{$llv -> ten}}</a></li>
        <hr>
        @endforeach
    </ul>
</li>