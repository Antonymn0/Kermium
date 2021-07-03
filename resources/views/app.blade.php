<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @if( Route::is('events create') || Route::is('events edit') || Route::is('sms create') || Route::is('sms edit') || Route::is('emails create') || Route::is('emails edit') )

        <!-- Jquery date time picker --> 
        <link rel="stylesheet" type="text/css" href="{{url('adminLTE/plugins/datetimepicker/jquery.datetimepicker.css')}}" >

        @endif 

        @if( Route::is('emails create') || Route::is('emails edit'))
        <!-- Summernote --> 
        <link rel="stylesheet" type="text/css" href="{{url('adminLTE/plugins/summernote/summernote-bs4.min.css')}}" >
        @endif

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
        
        @routes

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{url('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{url('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{url('adminLTE/dist/js/adminlte.js')}}"></script>

        <!-- jQuery Mapael -->
        <script src="{{url('adminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
        <script src="{{url('adminLTE/plugins/raphael/raphael.min.js')}}"></script>

        @if( Route::is('events create') || Route::is('events edit') || Route::is('sms create') || Route::is('sms edit') || Route::is('emails create') || Route::is('emails edit') )
        <!-- JQuery Date time picker --> 
        <script src="{{url('adminLTE/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script> 
        @endif 

        @if( Route::is('emails create') || Route::is('emails edit'))
        <!-- Summernote --> 
        <script src="{{url('adminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script> 
        @endif
    </body>
</html>
