<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>trinvh's API App Manager - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/backend/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/backend/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/select2/select2.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

@yield('after-styles')
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini">
<div class="wrapper">

    @include('layouts.partials.mainheader')

    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('layouts.partials.breadcrumb')

        <!-- Main content -->
        <section class="content">
            @include("shared.messages")
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.rightsidebar')

    <footer class="main-footer">
        <strong>Copyright &copy; 2016 <a href="http://trinvh.com">trinvh</a>.</strong>
    </footer>

</div><!-- ./wrapper -->

<script src="{{ asset('/assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/plugins/select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/plugins/laravel.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/js/custom.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/js/app.min.js') }}" type="text/javascript"></script>
<script>
$('.select2').select2();
</script>

@yield('after-scripts')
</body>
</html>
