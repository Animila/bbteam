<?php
date_default_timezone_set('Asia/Yakutsk');
    ?>
@extends('admin.layout.base')

@section ('add_link')

    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/flatpickr/flatpickr.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper bg-black">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Добавление новой главы</h2>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container bg-dark p-2">
{{--                action="{{route('chapter.store')}}" method="post"--}}
                <form  enctype="multipart/form-data" id="parameters">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="manga">Выберите мангу</label>
                                <select class="form-control bg-black" name="id_manga" id="manga">
                                    @foreach(\App\Models\Manga::all() as $manga)
                                        <option
                                           @if(old('id_manga') == null)
                                            {{\App\Models\Manga::all()->last()->id == $manga->id ?  'selected' : ''}}
                                           @else
                                               {{old('id_manga') == $manga->id ?  'selected' : ''}}
                                           @endif
                                            value="{{$manga->id}}">{{$manga->title_ru}}</option>
                                    @endforeach
                                </select>
                                @error('id_manga')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group form-number">
                                <label for="tom">Том</label>
                                <input class="form-control bg-black" type="number" value="{{\App\Models\Chapter::query()->orderBy('id', 'DESC')->first() ? \App\Models\Chapter::query()->orderBy('id', 'DESC')->first()->tom : '1'}}" name="tom" id="tom">
                            </div>
                            <div class="form-group form-number">
                                <label for="number">Номер</label>
                                <input class="form-control bg-black" type="number" value="{{\App\Models\Chapter::query()->orderBy('id', 'DESC')->first() ? \App\Models\Chapter::query()->orderBy('id', 'DESC')->first()->number : '1'}}" name="number" id="number">
                            </div>
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input class="form-control bg-black" type="text" placeholder="(необязательно)" name="title" value="{{old('title')}}" id="title">
                            </div>
                            <div class="d-none d-sm-block">
                                <input class="btn btn-success" type="button" onclick="submitForms()" value="Сохранить">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" {{old('premium') ? 'checked' : ''}} type="checkbox" name="premium" id="premium">
                                    <label class="custom-control-label" for="premium">Премиум</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" {{old('hide_18') ? 'checked' : ''}} type="checkbox" name="hide_18" id="hide_18">
                                    <label class="custom-control-label" for="hide_18">18+</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" {{old('hide') ? 'checked' : ''}} type="checkbox" name="hide" id="hide">
                                    <label class="custom-control-label" for="hide">Скрыть</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_of_free">Время бесплатной публикации</label>
                                <input class="form-control bg-black" type="datetime-local" placeholder="Выбрать" style="background: black;" name="date_of_free" id="date_of_free">
                                <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-date_of_free"></div>
                            </div>
                            <div class="col-12 d-sm-none">
                                <input class="btn btn-success" type="button" onclick="submitForms()" value="Сохранить">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="content mt-2 p-2">
                    <div class="row"><a class="btn btn-block btn-secondary" href="{{route('chapter')}}" type="button" style="width: 100px;">Назад</a></div>
                </div>
            </div>
            <div class="container py-2">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group bg-dark p-2">
                        <div class="text-monospace"><i>ВНИМАНИЕ!<br>- Загружать только архивы!<br> - Внутри архива располагать сканы в алфавитном порядке!<br>- При использовании цифр использовать формат: "01, 02, 11" (НЕ ИСПОЛЬЗОВАТЬ "1, 2, 3")</i></div>
                        <label for="exampleInputFile">Обложка</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input class="custom-file-input bg-dark" type="file" name="image" id="image">>
                                <label class="custom-file-label" for="image">Выбрать файл</label>
                            </div>
                        </div>
                        <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-image"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('add_script')

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('/plugins/flatpickr/ru.js')}}"></script>
    <script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script>

        $(function () {
            bsCustomFileInput.init()
        })
        $('.select2').select2()
        window.chapters = {
            id_chapter: 0
        };

        function chapterUpload() {
            let data = {
                'date_of_free': document.forms["parameters"].elements['date_of_free'].value,
                'id_manga': document.forms["parameters"].elements['id_manga'].value,
                'tom': document.forms["parameters"].elements['tom'].value,
                'number': document.forms["parameters"].elements['number'].value,
                'title': document.forms["parameters"].elements['title'].value,
                'hide': document.forms["parameters"].elements['hide'].value,
                'hide_18': document.forms["parameters"].elements['hide_18'].value,
                'premium_access': document.forms["parameters"].elements['premium'].value,
            }
            let error = false;
            if($('#date_of_free').val() == '') {
                $('#date_of_free').addClass('is-invalid')
                $('#error-date_of_free').html('Введите дату').removeClass('d-none')
                error = true;
            } else {
                $('#date_of_free').removeClass('is-invalid')
                $('#error-date_of_free').addClass('d-none')
            }
            if($('#image').val() == '') {
                $('#image').addClass('is-invalid')
                $('#error-image').html('Нет данных').removeClass('d-none')
                error = true;
            } else {
                $('#image').removeClass('is-invalid')
                $('#error-image').addClass('d-none')
            }
            if(error) {return false;}
            axios.post('{{route('chapter.store')}}', data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }).then(responce => {
                if(responce['data']['status']) {
                    imageUpload(responce['data']['id_chapter']);
                }
            }).catch(error => {
                console.log(error)
            });
        }

        function submitForms() {
            chapterUpload();
        }



        function imageUpload(id) {

            var formData = new FormData();
            let file = $('#image')[0].files[0];
            formData.append("image", file);
            formData.append("id_chapter", id);
            axios.post('{{route('image.store')}}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }).then(responce => {
                if(responce['data']['status']) {
                    location = '{{route('chapter')}}'
                }
            }).catch(error => {
                console.log(error)
            });
        }
        flatpickr('input[type=datetime-local]', {
            enableTime: true,
            dateFormat: "Y-m-d, H:i",
            time_24hr: true,
            "locale": "ru"
        })



    </script>
@endsection
