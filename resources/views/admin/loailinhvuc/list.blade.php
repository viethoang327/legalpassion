@extends('admin.layout.index')

@section('content')
<div class="main">
  <h1 class="main-title">Danh sách các lĩnh vực</h1>
  <div class="main-notation">
    <div>Tổng: <span class="entries-number">{{$sobanghi}}</span> bản ghi</div>
    <div class="main-notation-search">
      <form action="admin/danhmuclinhvuc/timkiem" method = "POST">
        @csrf
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm </button>
        <input class="sml-search" type="text" name="keyword" class="form-control" placeholder=" search ...">
      </form>
    </div>
  </div>
  <div class="main-content">
  @if(session('thongbao'))
      <div class="alert alert-success alert-disappear">
          {{ session('thongbao') }}
      </div>
      <script>
        setTimeout(function() {
          var alert = document.querySelector('.alert-disappear');
          alert.style.display = 'none';
        }, 3000);
      </script>
  @endif
    <div class="main-content__table">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên lĩnh vực</th>
            <th scope="col">Tên lĩnh vực không dấu</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          @foreach ($danhsachdanhmuc as $llv)
            <?php $i++ ?>
            <tr>
              <th scope="row"><?php echo $i ?></th>
              <td>{{ $llv->ten }}</td>
              <td>{{ $llv->tenkhongdau }}</td>
              <td>
                <a href="admin/danhmuclinhvuc/suadanhmuc/{{ $llv->id }}" class="btn btn-primary"><i class="fa fa-edit"></i> Sửa</a>
                <a href="admin/danhmuclinhvuc/xoadanhmuc/{{ $llv->id }}" class="btn btn-danger"
                onclick="return confirm('Bạn có chắc muốn xóa lĩnh vực này?')"><i class="fa fa-trash"></i> Xóa</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
     <!-- Phân trang -->
     <div class="mx-auto pb-10 w-4/5">
      {{ $danhsachdanhmuc->links("pagination::bootstrap-5") }}
    </div>

  </div>
</div>

@endsection
