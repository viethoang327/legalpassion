@extends('admin.layout.index')

@section('content')
    <div class="main">
        <h1 class="main-title">Sửa vấn đề</h1>
        <div class="main-content">  
            <form action="admin/vande/suavande/{{$vande->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="linhvuc">Lĩnh vực</label>
                    <select class="form-control" name="linhvuc" id="linhvuc">
                        @foreach($loailinhvuc as $llv)
                            <option 
                            @if($vande->id_loailinhvuc == $llv->id)
                             {{"selected"}}
                            @endif
                            value="{{ $llv->id }}">{{ $llv->ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ten">Tên vấn đề</label>
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Nhập tên vấn đề" 
                    value="{{$vande->ten}}">
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
