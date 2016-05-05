<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/backend/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/backend/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/select2/select2.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
@yield('content')
<script src="{{ asset('/assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>