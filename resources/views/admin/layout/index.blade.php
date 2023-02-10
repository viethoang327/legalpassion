<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/admin.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Admin - Management</title>
  <base href="{{asset('')}}">

</head>
<body>
    @include('admin.layout.header')
    @yield('content')
 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Toggle the dropdown menu when the dropdown button is clicked
    $('.dropdown-btn').click(function() {
    $(this).toggleClass('active');
    $(this).next('.dropdown-container').toggle();
    });
  </script>
  <script>
    $('.dropdown-btn').click(function() {
      $(this).next('.dropdown-container').toggleClass('show');
    });
  </script>
  @yield('script')
 <!-- CKEDITOR -->
  <script src="{{ asset('/ckeditor/ckeditor.js')}}">
  </script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
  <script>
   let editors = [];

      [ 'tomtat', 'noidung' ].forEach( editorId => {
          ClassicEditor
              .create( document.querySelector( '#' + editorId ), {
                  height: 800
              } )
              .then( editor => {
                  console.log( 'Editor was initialized', editor );
                  editors.push( editor );
              } )
              .catch( error => {
                  console.error( error.stack );
              } );
      } );

  </script>
</body>
</html>

