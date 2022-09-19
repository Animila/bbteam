@extends('admin.layout.base')

@section ('add_link')

    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <div class="content-wrapper bg-black">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Пользователи</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper bg-black">
            <section class="content">
                <div class="container bg-dark p-2">
                    <form  method="post" enctype="multipart/form-data" id="userSetting">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nick">Никнейм</label>
                                    <input class="form-control bg-black" type="text" placeholder="(необязательно)" name="nickname" value="{{$content['user']->nickname}}" id="nick">
                                    <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-nick"></div>
                                </div>
                                <div class="form-group">
                                    <label for="emmail">Почта</label>
                                    <input class="form-control bg-black" type="text" placeholder="(необязательно)" name="email" value="{{$content['user']->email}}" id="emmail">
                                    <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-emmail"></div>

                                </div>
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input class="form-control bg-black" type="text" placeholder="(необязательно)" name="name" value="{{$content['user']->name}}" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Пол: </label>
                                    <select class="form-control bg-black" name="gender" id="gender">
                                        <option {{$content['user']->gender == 'мужской' ? 'selected' : ''}} value="мужской">Мужской</option>
                                        <option {{$content['user']->gender == 'женский' ? 'selected' : ''}} value="женский">Женский</option>
                                        <option {{$content['user']->gender == 'Не выбрано' ? 'selected' : ''}} value="не выбрано">Не выбрано</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="about">О себе</label>
                                    <textarea class="form-control bg-black" type="text" placeholder="(необязательно)" name="about" id="about">{{$content['user']->about}}</textarea>
                                </div>

                                <div class="d-none d-sm-block">
                                    <input class="btn btn-success" type="button" onclick="updateStatics()" value="Сохранить">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    @if($content['user']->hide)
                                        <a class="btn btn-warning px-9" href="{{route('users.unban', $content['user']->id)}}">Разбан</a>
                                    @else
                                        <a class="btn btn-danger px-9" href="{{route('users.ban', $content['user']->id)}}">Бан</a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input class="custom-control-input" {{$content['user']->hide_18 ? 'checked' : ''}} type="checkbox" name="hide_18" id="hide_18">
                                        <label class="custom-control-label" for="hide_18">18+</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input class="custom-control-input" {{$content['user']->premium ? 'checked' : ''}} type="checkbox" name="premium" id="premium">
                                        <label class="custom-control-label" for="premium">Премиум</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role">Статус: </label>
                                    <select class="form-control bg-black" name="role" id="role">
                                        <option {{$content['user']->role == 'admin' ? 'selected' : ''}} value="admin">Админ</option>
                                        <option {{$content['user']->role == 'user' ? 'selected' : ''}} value="user">Пользователь</option>
                                        <option {{$content['user']->role == 'redactor' ? 'selected' : ''}} value="redactor">Редактор</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group p-3 mt-5 border">
                        <form class="form-horizontal" id="reset_password">
                            @csrf
                            <div class="form-group row">
                                <label for="now_pass" class="col-sm-2 col-form-label">Текущий пароль</label>
                                <div class="col-sm-10">
                                    <input id="now_pass" type="password" class="form-control bg-black" name="old_password" required>
                                    <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-now_pass"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-sm-2 col-form-label">Новый пароль</label>
                                <div class="col-sm-10">
                                    <input id="new_password" type="password" class="form-control bg-black" name="password" required>
                                    <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-new_password"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirm" class="col-sm-2 col-form-label">Повторить</label>
                                <div class="col-sm-10">
                                    <input id="password_confirm" type="password" class="form-control bg-black" name="password_confirmation" required>
                                    <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-password_confirm"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a class="btn btn-outline-danger" onclick="updatePassword()">Сохранить</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 d-sm-none">
                        <input class="btn btn-success" type="button" onclick="updateStatics()" value="Сохранить">
                    </div>
                    <div class="content mt-2 p-2">
                        <div class="row"><a class="btn btn-block btn-secondary" href="{{route('users')}}" type="button" style="width: 100px;">Назад</a></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('add_script')

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init()
        })
        $('.select2').select2()

        function updatePassword() {
            let error = false;

            if ($('#now_pass').val() !== '') {
                $('#now_pass').removeClass('is-invalid')
                $('#error-now_pass').addClass('d-none');
            } else {
                $('#now_pass').addClass('is-invalid')
                $('#error-now_pass').html('Введите пароль').removeClass('d-none');
                error = true;
            }

            if ($('#new_password').val() === '') {
                $('#new_password').addClass('is-invalid')
                $('#error-new_password').html('Заполните пароль').removeClass('d-none');
                error = true;
            } else {
                console.log('Есть пароль')
                $('#new_password').removeClass('is-invalid')
                $('#error-new_password').addClass('d-none');
            }

            if ($('#password_confirm').val() === '') {
                $('#password_confirm').addClass('is-invalid')
                $('#error-password_confirm').html('Подтвердите пароль').removeClass('d-none');
                error = true;
            } else {
                console.log('Есть пароль')
                $('#password_confirm').removeClass('is-invalid')
                $('#error-password_confirm').addClass('d-none');
            }

            if ($('#password_confirm').val() != $('#new_password').val()) {
                console.log('Не совпадают')
                $('#password_confirm').addClass('is-invalid')
                $('#error-new_password').html('Пароли не совпадают').removeClass('d-none');
                error = true;
            } else {
                console.log('Совпадают')
                $('#password_confirm').removeClass('is-invalid')
                $('#error-new_password').addClass('d-none');
            }

            let data = {
                'old_password': $('#now_pass').val(),
                'password': $('#new_password').val(),
                'password_confirmation': $('#password_confirm').val(),
                '_method': 'PATCH',
            }

            if(error) {
                console.log('Нет ошибок')
                return false
            }

            axios.post('{{route('users.password.update', $content['user']->id)}}', data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            }).then(responce => {
                if(responce['data']['status']) {
                    location.reload()
                }
                if (!responce['data']['status']) {
                    $('#now_pass').addClass('is-invalid')
                    $('#error-now_pass').html(responce['data']['error']).removeClass('d-none');
                }
            }).catch(error => {
                console.log(error);
            });



            console.log('Ошибки')


        }


        function updateStatics() {
            data = {
                '_method': 'PATCH',
                'nickname': document.forms["userSetting"].elements['nick'].value,
                'email': document.forms["userSetting"].elements['emmail'].value,
                'name': document.forms["userSetting"].elements['name'].value,
                'gender': document.forms["userSetting"].elements['gender'].value,
                'about': document.forms["userSetting"].elements['about'].value,
                'hide_18': document.forms["userSetting"].elements['hide_18'].checked,
                'premium': document.forms["userSetting"].elements['premium'].checked,
                'id': '{{$content['user']->id}}',
                'role': document.forms["userSetting"].elements['role'].value,
            }
            axios.post('{{url(route('users.update', $content['user']->id))}}', data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            }).then(responce => {
                if(responce['data']['status']) {
                    location.reload()
                }
                if (!responce['data']['status']) {
                    alert(responce['data']['error'])
                }
            }).catch(error => {
                if(error.response.data.errors.email) {
                    $('#emmail').addClass('is-invalid')
                    $('#error-emmail').html(error.response.data.errors.email).removeClass('d-none')
                }
                if(error.response.data.errors.nickname) {
                    $('#nick').addClass('is-invalid')
                    $('#error-nick').html(error.response.data.errors.nickname).removeClass('d-none')
                }

            });
        }
    </script>
@endsection
