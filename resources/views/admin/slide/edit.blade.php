@extends('admin.layout.index')

@section('content')
    <div class="main">
        <h1 class="main-title">Sửa slide</h1>
        @if(count($errors) > 0)
            <div class="alert alert-danger" style="color:red">
                @foreach($errors->all() as $err)
                    {{ $err }}<br>
                @endforeach
            </div>
        @endif
        @if(session('thongbao'))
            <div class="alert alert-success" style="color:green">
                {{ session('thongbao') }}
            </div>
        @endif

        <div class="main-content">  
            <form action="admin/slide/edit/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên slide</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="{{$slide->ten}}">
                </div>
                <div class="form-group">
                    <label for="noidung">Nội dung</label>
                    <textarea class="form-control" id="noidung" name="noidung">{{$slide->noidung}}</textarea>
                </div>
                <div class="form-group">
                    <label for="hinhanh">Hình ảnh</label>
                    <p>
                        <img width="400px" src="upload/slide/{{$slide->hinhslide}}" alt="{{$slide->hinhslide}}">
                    </p>
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh" style="height:30px;width:540px;">
                    @if(session('loi'))
                        <span class="alert alert-danger" style="color:red">
                            {{ session('loi') }}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{$slide->link}}">
                </div>
                <div class="btn-section">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                    <button type="reset" class="btn btn-reset">Làm mới</button>
                </div>
            </form>
        </div>    
    </div>
@endsection
