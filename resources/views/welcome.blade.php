<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Логин</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}">
</head>
<body class="bg-black">
<div class="welcome-form bg-dark">
    @auth()
        <h4>ВЫ АВТОРИЗОВАНЫ</h4>
        <a href="{{route('logout')}}" class="btn btn-danger d-block mx-auto my-1">ВЫЙТИ</a>

    @else
        <h4 class="text-center">ВЫ НЕ АВТОРИЗОВАНЫ</h4>
        <a href="{{route('login')}}" class="btn btn-success d-block mx-auto my-1">ЛОГИН</a>
        <a href="{{route('register')}}" class="btn btn-secondary d-block mx-auto my-1">РЕГИСТРАЦИЯ</a>
    @endauth
    @can('for_admin_user')
        <a href="{{route('statistics')}}" class="btn btn-warning d-block mx-auto my-1">АДМИН ПАНЕЛЬ</a>
    @endcan

</div>
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>

</body>
</html>
