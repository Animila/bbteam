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
    <style>
        .file-upload label input { display: none; opacity: 0; }
    </style>
    <div class="content-wrapper bg-black">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Редактирование {{$content['chapter']->title}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container bg-dark p-2">
                <form action="{{route('chapter.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <input type="hidden" name="id_chapter" value="{{$content['chapter']->id}}">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="manga">Выберите мангу</label>
                                <select class="form-control bg-black" name="id_manga" id="manga">
                                    @foreach(\App\Models\Manga::all() as $manga)
                                        <option {{$content['chapter']->id_manga == $manga->id ? 'selected' : ''}} value="{{$manga->id}}">{{$manga->title_ru}}</option>
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
                                <input class="form-control bg-black" type="number" value="{{$content['chapter']->tom}}" name="tom" id="tom">
                            </div>
                            <div class="form-group form-number">
                                <label for="number">Номер</label>
                                <input class="form-control bg-black" type="number" value="{{$content['chapter']->number}}" name="number" id="number">
                            </div>
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input class="form-control bg-black" type="text" placeholder="(необязательно)" name="title" value="{{$content['chapter']->title}}" id="title">
                            </div>
                            <div class="d-none d-sm-block">
                                <button class="btn btn-success" type="submit">Сохранить</button>
                                <a class="btn btn-danger" onclick="document.getElementById('delete').submit();">Удалить</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" {{$content['chapter']->premium_access ? 'checked' : ''}} type="checkbox" name="premium" id="premium">
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
                                    <input class="custom-control-input" {{$content['chapter']->hide ? 'checked' : ''}} type="checkbox" name="hide" id="hide">
                                    <label class="custom-control-label" for="hide">Скрыть</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Время бесплатной публикации</label>
                                <input class="form-control bg-black" type="datetime-local" placeholder="Выбрать" style="background: black;" name="date_of_free" value="{{$content['chapter']->date_of_free}}">
                            </div>
                            <div class="col-12 d-sm-none">
                                <button class="btn btn-success" type="submit">Сохранить</button>
                                <a class="btn btn-danger" onclick="document.getElementById('delete').submit();">Удалить</a>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{route('chapter.delete', $content['chapter']->id)}}" method="post" id="delete">
                    @method('delete')
                    @csrf
                </form>
                <div class="content mt-2 p-2">
                    <div class="row"><a class="btn btn-block btn-secondary" href="{{route('chapter')}}" type="button" style="width: 100px;">Назад</a></div>
                </div>
            </div>
            <div class="container py-2">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group bg-dark p-2">
                        <label for="exampleInputFile">Добавить скан</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input class="custom-file-input bg-dark" type="file" name="image" id="image" onchange="addImage()">
                                <input type="hidden" name="id_chapter" id="id_chapter" value="{{$content['chapter']->id}}">
                                <label class="custom-file-label" for="image">Выбрать файл</label>
                            </div>
                        </div>
                        <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-image"></div>
                    </div>
                </form>
                <div class="row mt-5 d-none d-sm-block">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th class="col-1">Id</th>
                            <th class="col-1">Скан</th>
                            <th class="col-2">URL</th>
                            <th class="col-1">Номер</th>
                            <th class="col-2">Обновить</th>
                            <th class="col-1">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($content['chapter']->scans as $scan)
                            <tr>
                                <th>{{$scan->id}}</th>
                                <th><img class="d-block mx-auto mb-3 w-75" src="{{asset($scan->url)}}"></th>
                                <th><a href="{{asset($scan->url)}}">{{asset($scan->url)}}</a></th>
                                <th>{{$scan->number}}</th>
                                <th>
                                    <form method="post" enctype="multipart/form-data" id="imageUpdate">
                                        @csrf
                                        <div class="input-group">
                                            <input class="bg-dark" type="file" name="image" id="{{$scan->id}}" onchange="updateImage({{$scan->id}})">
                                        </div>
                                    </form>
                                </th>
                                <th>
                                    <form action="{{route('image.delete', $scan->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        <button class="btn" type="submit"><i class="fas fa-trash text-light"></i></button>
                                    </form>
                                </th>
                            </tr>
                            <script>
                                function updateImage(id) {
                                    let file = $('#'+id)[0].files[0];
                                    let formData = new FormData();
                                    formData.append("image", file);
                                    formData.append("_method", 'PATCH');
                                    axios.post('{{url('admin/chapters/scan')}}/'+id, formData, {
                                        headers: {
                                            'Content-Type': 'multipart/form-data',
                                        },
                                    }).then(responce => {
                                        if(responce['data']['status']) {
                                            location = "{{route('chapter.edit', $content['chapter']->id)}}"
                                        }
                                        if(!responce['data']['status']) {
                                            alert(responce['data']['error'])
                                        }
                                    }).catch(error => {
                                        console.log('Ошибка здесь: ' + error)
                                    });
                                }
                            </script>

                        @endforeach

                        </tbody>
                    </table>
                </div>
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
        function addImage() {
            let file = $('#image')[0].files[0];
            let formData = new FormData();
            formData.append("image", file);
            formData.append("id_chapter", '{{$content['chapter']->id}}');
            axios.post('{{route('image.add', $content['chapter']->id)}}', formData, {
                headers: {
                'Content-Type': 'multipart/form-data',
            },
            }).then(responce => {
                if(responce['data']['status']) {
                    location = "{{route('chapter.edit', $content['chapter']->id)}}"
                }
                if(!responce['data']['status']) {
                    $('#image').addClass('is-invalid')
                    $('#error-image').html(responce['data']['error']).removeClass('d-none')
                }
            }).catch(error => {
                console.log('Ошибка здесь: ' + error)
            });
        }

        $(function () {
            bsCustomFileInput.init()
        })
        $('.select2').select2()
        window.chapters = {
            id_chapter: 0
        };


        flatpickr('input[type=datetime-local]', {
            enableTime: true,
            dateFormat: "Y-m-d, H:i",
            time_24hr: true,
            "locale": "ru"
        })

    </script>
@endsection
