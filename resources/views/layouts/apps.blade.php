<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') - DTS System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    {{-- data tables --}}
    <link href="{{asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    {{-- steps form --}}
    <link href="{{asset('assets/plugins/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
    {{-- summernote --}}
    <link href="{{asset('assets/plugins/summernote/dist/summernote.css')}}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/mystyle.css')}}" rel="stylesheet">

</head>

<body class="h-100">

    
    <!--**********************************
        Main wrapper start
        ***********************************-->
    @auth
    <div id="main-wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')
    @endauth
    {{--sectios--}}
    
    @yield('contents')

    {{-- enn sections --}}

    @auth
    @include('layouts.footer')
    </div>
    @endauth            
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/gleek.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script>
    
    {{-- form stepts --}}
    <script src="{{asset('assets/plugins/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins-init/jquery-steps-init.js')}}"></script>
    

    {{-- data tables --}}
    <script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
    
    {{-- summernote --}}
    <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>

    {{-- myscripts --}}
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
