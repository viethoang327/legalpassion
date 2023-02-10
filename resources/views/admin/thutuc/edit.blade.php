@extends('admin.layout.index')

@section('content')
    <div class="main">
        <h1 class="main-title">Sửa thủ tục</h1>
        <h2 style="text-align: center;">{{$thutuc -> tieude}}</h2>
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
            <form action="admin/thutuc/suathutuc/{{$thutuc->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tieude">Tiêu đề thủ tục</label>
                    <input type="text" class="form-control" id="tieude" name="tieude" placeholder="Nhập tiêu đề" value="{{$thutuc->tieude}}">
                </div>
                <div class="form-group">
                    <label for="tomtat">Tóm tắt</label>
                    <textarea class="form-control" id="tomtat" name="tomtat">$thutuc->tomtat}}</textarea>
                </div>
                <div class="form-group">
                    <label for="noidung">Nội dung</label>
                    <textarea class="form-control" id="noidung" name="noidung">{{$thutuc->noidung}}</textarea>
                </div>
                <div class="form-group">
                    <label for="hinhanh">Hình ảnh</label>
                    <p>
                        <img src="upload/thutuc/{{$thutuc->hinhanh}}" alt="{{$thutuc->hinhanh}}" width="400px">
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
                        @if($thutuc->noibat == 1)
                            {{"checked"}}
                        @endif
                      type="radio" class="form-control-checkbox" id="noibat" name="noibat" value="1"> Có </div>
                    <div><input 
                        @if($thutuc->noibat == 0)
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