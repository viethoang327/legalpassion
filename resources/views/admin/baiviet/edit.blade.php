@extends('admin.layout.index')

@section('content')
    <div class="main">
        <h1 class="main-title">Sửa bài viết</h1>
        <h2 style="text-align: center;">{{$baiviet -> tieude}}</h2>
        @if(count($errors) > 0)
            <span class="alert alert-danger" style="color:red">
                @foreach($errors->all() as $err)
                    {{ $err }}<br>
                @endforeach
            </span>
        @endif
        @if(session('thongbao'))
            <span class="alert alert-success" style="color:green">
                {{ session('thongbao') }}
            </span>
        @endif

        <div class="main-content">  
            <form action="admin/baiviet/suabaiviet/{{$baiviet->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="linhvuc">Lĩnh vực</label>
                    <select class="form-control" name="linhvuc" id="linhvuc">
                            <option value="" selected>Lựa chọn lĩnh vực</option>
                        @foreach($loailinhvuc as $llv)
                            <option 
                                @if($baiviet->linhvuc->loailinhvuc->id == $llv->id)
                                    {{"selected"}}
                                @endif
                            value="{{ $llv->id }}">{{ $llv->ten }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="vande">Vấn đề</label>
                    <select class="form-control" name="vande" id="vande">
                        @foreach($vande as $vd)
                            <option 
                                @if($baiviet->id == $vd->id)
                                    {{"selected"}}
                                @endif
                            value="{{ $vd->id }}">{{ $vd->ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tieude">Tiêu đề bài viết</label>
                    <input type="text" class="form-control" id="tieude" name="tieude" placeholder="Nhập tiêu đề" value="{{$baiviet->tieude}}">
                </div>
                <div class="form-group">
                    <label for="tomtat">Tóm tắt</label>
                    <textarea class="form-control" id="tomtat" name="tomtat">{{$baiviet->tomtat}}</textarea>
                </div>
                <div class="form-group">
                    <label for="noidung">Nội dung</label>
                    <textarea class="form-control" id="noidung" name="noidung">{{$baiviet->noidung}}</textarea>
                </div>
                <div class="form-group">
                    <label for="hinhanh">Hình ảnh</label>
                    <p>
                        <img src="upload/baiviet/{{$baiviet->hinhanh}}" alt="{{$baiviet->hinhanh}}" width="400px">
                    </p>
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh" style="height:30px;width:540px;">
                    @if(session('loi'))
                        <span class="alert alert-danger" style="color:red">
                            {{ session('loi') }}
                        </span>
                    @endif
            </span>
                </div>
                <div class="form-checkbox">
                    <label for="noibat">Nổi bật</label>
                    <div><input 
                        @if($baiviet->noibat == 1)
                            {{"checked"}}
                        @endif
                      type="radio" class="form-control-checkbox" id="noibat" name="noibat" value="1"> Có </div>
                    <div><input 
                        @if($baiviet->noibat == 0)
                            {{"checked"}}
                        @endif
                    type="radio" class="form-control-checkbox" id="noibat" name="noibat" value="0"> Không </div>
                </div>
                <div class="btn-section">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                    <button type="reset" class="btn btn-reset">Làm mới</button>
                </div>
            </form>
        </div>    
    </div>
@endsection
@section('script')
    <!-- <script src="jquery-3.6.1.min.js"></script> -->
    <script>
        $(document).ready(function(){
            $('#linhvuc').change(function(){
                var idLinhVuc = $(this).val();
                $.get("admin/ajax/linhvuc/"+idLinhVuc, function(data){
                    $('#vande').html(data);
                });
            });
        });
    </script>
   
@endsection