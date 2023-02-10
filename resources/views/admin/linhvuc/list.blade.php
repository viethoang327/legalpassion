@extends('admin.layout.index')

@section('content')
<div class="main">
  <h1 class="main-title">Chi tiết các lĩnh vực</h1>
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
  <div class="main-notation">
    <div>Tổng: <span class="entries-number">{{$sobanghi}}</span> bản ghi</div>
    <div class="main-notation-search">
      <form action="admin/vande/timkiem" method = "POST">
        @csrf
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm </button>
        <input class="sml-search" type="text" name="keyword" class="form-control" placeholder=" search ...">
      </form>
    </div>
  </div>
  <div class="main-content">
    <div class="main-content__table">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên vấn đề</th>
            <th scope="col">Tên vấn đề không dấu</th>
            <th scope="col">Thuộc Lĩnh vực</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0 ?>
          @foreach ($vande as $vd)
            <?php $i++ ?>
            <tr>
              <th scope="row"><?php echo $i ?></th>
              <td>{{ $vd->ten }}</td>
              <td>{{ $vd->tenkhongdau }}</td>
              <td>{{ $vd->loailinhvuc->ten }}</td>
              <td>
                <div class="table-button">
                <a href="admin/vande/suavande/{{ $vd->id }}" class="btn btn-primary"><i class="fa fa-edit"></i> Sửa</a>
                <a href="admin/vande/xoavande/{{ $vd->id }}" class="btn btn-danger" 
                onclick="return confirm('Bạn có chắc muốn xóa vấn đề này?')"><i class="fa fa-trash"></i> Xóa</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Phân trang -->
    <div class="mx-auto pb-10 w-4/5">
      {{ $vande->links("pagination::bootstrap-5") }}
    </div>

  </div>
</div>

@endsection
