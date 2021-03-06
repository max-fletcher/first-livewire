<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>AdminLTE 3 | Starter</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
   {{-- Livewire Styles --}}
   @livewireStyles
   {{-- Toastr Styles --}}
   <link type="text/css" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
</head>
<body class="hold-transition sidebar-mini">
   <div class="wrapper">

      @include('admin.partials.navbar')
      @include('admin.partials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         {{-- uses laravel slots --}}
         {{ $slot }}
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
         <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
         </div>
      </aside>
      <!-- /.control-sidebar -->

      @include('admin.partials.footer')
      </div>
      <!-- ./wrapper -->

      <!-- REQUIRED SCRIPTS -->

      <!-- jQuery -->
      <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
      {{-- Livewire Scripts --}}
      @livewireScripts
      {{-- Toastr scripts --}}
      <script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>

      {{-- Events for user submission. Has taostr or bootstrap --}}
      <script>
         $(document).ready(function(){
            toastr.options = {
               // "closeButton": false,
               // "debug": false,
               // "newestOnTop": false,
               "progressBar": true,
               "positionClass": "toast-top-right",
               // "preventDuplicates": false,
               // "onclick": null,
               // "showDuration": "300",
               // "hideDuration": "1000",
               // "timeOut": "5000",
               // "extendedTimeOut": "1000",
               // "showEasing": "swing",
               // "hideEasing": "linear",
               // "showMethod": "fadeIn",
               // "hideMethod": "fadeOut"
            }

            window.addEventListener('hide-form', event =>{
               $('#form').modal('hide')
               toastr.success(event.detail.message, "Success!")
            })
         });
      </script>

      {{-- Listeners for livewire event that is in app/http/livewire/admin/list-users called "show-form". It has Jquery syntax. It takes element with id="form" and attaches
      the "show" class to it. See Bootstrap docs. --}}
      <script>
         window.addEventListener('show-form', event =>{
            $('#form').modal('show')
         })
      </script>
</body>
</html>
