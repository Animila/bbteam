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
<div class="login-form bg-dark">
    <form id="login">
        @csrf
        <h3 class="text-center">Авторизация</h3>
        <div class="form-group">
            <label for="email">Почта: </label>
            <input type="email" name="email" placeholder="почта" class=" form-control bg-black" id="email">
            <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-email">
                <p id="error-email-p"></p>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" name="password" placeholder="пароль" class="bg-black form-control" id="password">

            <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-password">
                <p id="error-password-p"></p>
            </div>

        </div>

        <div class="form-group">
            <label for="remember">Запомнить?</label>
            <input type="checkbox" name="remember" id="remember">
        </div>

        <a href="{{route('auth.social', 'vkontakte')}}" class="btn btn-outline-primary d-block mx-auto my-2 w-100">Авторизация по вк</a>


        <input type="button" class="btn bg-black d-block mx-auto my-2 w-100" onclick="call()" value="Войти">

    </form>
    <a href="{{route('main')}}" class="btn btn-secondary d-block mx-auto w-50 my-4">Назад</a>

</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-black">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ошибка авторизации</h5>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script>
    function call() {
        var error = false;
        if ($('#email').val() == '' ) {
            $('#email').addClass('is-invalid')
            $('#error-email-p').html('Введите email')
            $('#error-email').removeClass('d-none');
            error = true;
        } else {
            $('#email').removeClass('is-invalid')
            $('#error-email').addClass('d-none');
            error = false;
        }
        if ($('#password').val() == '') {
            $('#password').addClass('is-invalid')
            $('#error-password-p').html('Введите пароль')
            $('#error-password').removeClass('d-none');
            error = true;
        } else {
            $('#password').removeClass('is-invalid')
            $('#error-password').addClass('d-none');
            error = false;
        }
        if(error){return true;}
        $.ajax({
            type: 'POST',
            url: '{{route('auth')}}',
            data: $('#login').serialize(),
            dataType:'json',
            success: function (data) {
                if(data['status']) {
                    location = '{{route('main')}}';
                }
                if(!data['status']) {
                    $('.modal-body').html(data['error'])
                    const myModal = new bootstrap.Modal(document.getElementById('myModal', {
                        backdrop: true,
                        keyboard: true,
                        focus: true
                    }))
                    myModal.show()
                }
                if(data['error']) {
                    if(data['type'] === 'email') {
                        $('#email').addClass('is-invalid')
                        $('#error-email-p').html(data['error'])
                        $('#error-email').removeClass('d-none');
                    } else {
                        $('#email').removeClass('is-invalid')
                        $('#error-email').addClass('d-none');
                    }
                    if(data['type'] === 'password') {
                        $('#password').addClass('is-invalid')
                        $('#error-password-p').html(data['error'])
                        $('#error-password').removeClass('d-none');
                    } else {
                        $('#password').removeClass('is-invalid')
                        $('#error-password').addClass('d-none');
                        error = false;
                    }
                }

            },
            error: function (xhr, str) {
                alert('Возникла ошибка: ' + xhr);
            }
        });

    }
</script>
</body>
</html>
