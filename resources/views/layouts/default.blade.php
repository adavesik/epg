<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_base_url" content="{{ url('/') }}">
<head>
    <!-- data tables css -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    @include('includes.head')
</head>
<body class="">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
    @include('includes.sidebar')
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    @include('includes.header')
</header>
<!-- [ Header ] end -->


<!-- [ Main Content ] start -->
@yield('content')

<!-- [ Main Content ] end -->

<!-- Required Js -->
<script src={{ asset('assets/js/vendor-all.min.js') }}></script>
<script src={{ asset('assets/js/plugins/bootstrap.min.js') }}></script>
<script src={{ asset('assets/js/ripple.js') }}></script>
<script src={{ asset('assets/js/pcoded.min.js') }}></script>

<script src={{asset('assets/js/pages/widget-data.js')}}></script>

<!-- pnotify Js -->
<script src={{ asset('assets/js/plugins/PNotify.js') }}></script>
<script src={{ asset('assets/js/plugins/PNotifyButtons.js') }}></script>
<script src={{ asset('assets/js/plugins/PNotifyCallbacks.js') }}></script>
<script src={{ asset('assets/js/plugins/PNotifyDesktop.js') }}></script>
<script src={{ asset('assets/js/plugins/PNotifyConfirm.js') }}></script>
<script src={{ asset('assets/js/pages/notify-event.js') }}></script>

<!-- select2 Js -->
<script src={{ asset('assets/js/plugins/select2.full.min.js') }}></script>
<!-- form-select-custom Js -->
<script src={{ asset('assets/js/plugins/select2.full.min.js') }}></script>

<!-- datepicker js -->
<script src={{ asset('assets/js/plugins/moment.min.js') }}></script>
<script src={{ asset('assets/js/plugins/daterangepicker.js') }}></script>
<script src={{ asset('assets/js/pages/ac-datepicker.js') }}></script>

<!-- sweet alert Js -->
<script src={{ asset('assets/js/plugins/sweetalert.min.js') }}></script>
<script src={{ asset('assets/js/pages/ac-alert.js') }}></script>
<script src="{{asset('js/dialog-box.js')}}"></script>
{{--Dialog Box--}}
@if(session()->has('success'))
    <script>
        swal("Success!", "{{session()->get('success')}}", "success");
    </script>
@endif
{{--End Dialog Box--}}

@stack('scripts')

</body>

</html>
