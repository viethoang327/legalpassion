@extends('admin.layout.index')

@section('content')
<div class="main">
    <h1 class="main-title">Sửa lĩnh vực</h1>
    <div class="main-content">
        @if(count($errors) > 0 && $errors->has('ten'))
        <div class="alert alert-danger" style="color:red">
            @foreach($errors->get('ten') as $err)
            {{ $err }}<br>
            @endforeach
        </div>
        @endif
        @if(session('thongbao'))
        <div class="alert alert-success" style="color:green">
            {{ session('thongbao') }}
        </div>
        @endif
        <form action="admin/danhmuclinhvuc/suadanhmuc/{{$loailinhvuc->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ten">Tên lĩnh vực</label>
                <input type="text" class="form-control" id="ten" name="ten"  value="{{$loailinhvuc->ten}}">
            </div>
            <div class="form-group">
                <label for="noidung">Mô tả</label>
                <textarea class="form-control" id="noidung" name="mota">{!!$loailinhvuc->mota!!}</textarea>
            </div>
            <div class="form-group">
                <label for="hinhanh">Hình ảnh</label>
                <p>
                    <img src="upload/linhvuc/{{$loailinhvuc->hinhanh}}" alt="{{$loailinhvuc->hinhanh}}" width="400px">
                </p>
                <input type="file" class="form-control" id="hinhanh" name="hinhanh" style="height:30px;width:540px;">
                @if(session('loi'))
                <span class="alert alert-danger" style="color:red">
                    {{ session('loi') }}
                </span>
                @endif
            </div>
            <div class="btn-section">
                <button type="submit" class="btn btn-primary">Sửa</button>
                <button type="reset" class="btn btn-reset">Làm mới</button>
            </div>
        </form>
    </div>
</div>
@endsection