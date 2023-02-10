@extends('admin.layout.index')

@section('content')
    <div class="main">
    <h1 class="main-title">Sửa lĩnh vực</h1>
        <div class="main-content">
            <form action="admin/danhmuclinhvuc/suadanhmuc/{{$loailinhvuc->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên lĩnh vực</label>
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Nhập tên lĩnh vực" value="{{$loailinhvuc->ten}}">
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
                </div>
                <div class="btn-section">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                    <button type="reset" class="btn btn-reset">Làm mới</button>
                </div>
            </form>
        </div>  
    </div>
@endsection
