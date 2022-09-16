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
<div class="register-form bg-dark">
    <h3 class="text-center">Регистрация</h3>
    <form action="{{route('reg')}}" method="post" class="mt-3" id="register">
        @csrf
        <div class="form-group">
            <label for="nickname">Никнейм: </label>
            <input type="text" name="nickname" placeholder="(Обязательно)" id="nickname" class="form-control bg-black">
            <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-nickname"></div>
        </div>
        <div class="form-group">
            <label for="name">Имя: </label>
            <input type="text" name="name" placeholder="(Обязательно)" id="name" class="form-control bg-black">
            <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-name"></div>
        </div>
         <div class="form-group">
             <label for="gender">Пол: </label>
                 <select class="form-control bg-black" name="gender" id="gender">
                         <option value="мужской">Мужской</option>
                         <option value="женский">Женский</option>
                         <option value="Не выбрано" selected>Не выбрано</option>
                 </select>
         </div>
         <div class="form-group">
             <label for="email">Почта: </label>
             <input type="email" name="email" placeholder="почта" id="email" class="form-control bg-black">
             <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-email"></div>
         </div>
         <div class="form-group">
             <label for="password">Пароль: </label>
             <input type="password" name="password" placeholder="пароль" id="password" class="form-control bg-black">
             <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-password"></div>
         </div>
         <div class="form-group">
             <label for="password_check">Подтверждение пароля: </label>
             <input type="password" name="password_confirmation" placeholder="повторить пароль" id="password_check" class="form-control bg-black">
             <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-password_check"></div>
         </div>

        <a class="btn btn-success d-block mx-auto w-100" onclick="call()">Зарегистрироваться </a>
        <a href="{{route('main')}}" class="btn btn-secondary d-block mx-auto w-50 my-4">Назад</a>

    </form>
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

            if ($('#nickname').val() == '' ) {
                $('#nickname').addClass('is-invalid')
                $('#error-nickname').html('Введите никнейм').removeClass('d-none');
                error = true;
            } else {
                $('#nickname').removeClass('is-invalid')
                $('#error-nickname').addClass('d-none');
                error = false;
            }

            if ($('#email').val() == '' ) {
                $('#email').addClass('is-invalid')
                $('#error-email').html('Введите почту').removeClass('d-none');
                error = true;
            } else {
                $('#email').removeClass('is-invalid')
                $('#error-email').addClass('d-none');
                error = false;
            }

            if ($('#name').val() == '' ) {
                $('#name').addClass('is-invalid')
                $('#error-name').html('Введите имя').removeClass('d-none');
                error = true;
            } else {
                $('#name').removeClass('is-invalid')
                $('#error-name').addClass('d-none');
                error = false;
            }

            if ($('#password_check').val() != $('#password').val() ) {
                $('#password_check').addClass('is-invalid')
                $('#error-password_check').html('Пароли не совпадают').removeClass('d-none');
                error = true;
            } else {
                $('#password_check').removeClass('is-invalid')
                $('#error-password_check').addClass('d-none');
                error = false;
            }

            if ($('#password').val() == '') {
                $('#password').addClass('is-invalid')
                $('#error-password').html('Введите пароль').removeClass('d-none');
                error = true;
            } else {
                $('#password').removeClass('is-invalid')
                $('#error-password').addClass('d-none');
                error = false;
            }

            if(error){return true;}
            $.ajax({
                type: 'POST',
                url: '{{route('reg')}}',
                data: $('#register').serialize(),
                dataType:'json',
                success: function (data) {
                    if(data['status']) {
                        location = '{{route('login')}}';
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
                        if(data['type'] === 'nickname') {
                            $('#nickname').addClass('is-invalid')
                            $('#error-nickname').html(data['error']).removeClass('d-none');
                            error = true;
                        } else {
                            $('#nickname').removeClass('is-invalid')
                            $('#error-nickname').addClass('d-none');
                            error = false;
                        }

                        if(data['type'] === 'email') {
                            $('#email').addClass('is-invalid')
                            $('#error-email').html(data['error']).removeClass('d-none');
                            error = true;
                        } else {
                            $('#email').removeClass('is-invalid')
                            $('#error-email').addClass('d-none');
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
