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
                        <h2>Добавление нового тайтла</h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container bg-dark p-2">
                <form action="{{route('titles.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm">

                            <div class="form-group">
                                <label for="title_ru">Русское название</label>
                                <input class="form-control bg-black @error('title_ru') is-invalid @enderror" type="text" placeholder="(обязательно)" name="title_ru" value="{{old('title_ru')}}" id="title_ru @error('title_ru') inputError @enderror">
                                @error('title_ru')
                                    <div class="callout callout-danger bg-black mt-1 p-1">
                                        <p>{{$message}}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title_eng">Английское название</label>
                                <input class="form-control bg-black @error('title_eng') is-invalid @enderror" type="text" placeholder="(обязательно)" name="title_eng" value="{{old('title_eng')}}" id="title_eng @error('title_eng') inputError @enderror">
                                @error('title_eng')
                                    <div class="callout callout-danger bg-black mt-1 p-1">
                                        <p>{{$message}}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_kor">Корейское название</label>
                                <input class="form-control bg-black @error('title_korean') is-invalid @enderror" type="text" placeholder="(необязательно)" name="title_korean" value="{{old('title_korean')}}" id="title_korean @error('title_korean') inputError @enderror">
                                @error('title_korean')
                                    <div class="callout callout-danger bg-black mt-1 p-1">
                                        <p>{{$message}}</p>
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="about">Описание</label>
                                <textarea class="form-control bg-black @error('description') is-invalid @enderror" rows="3" placeholder="(обязательно)" name="description" id="about @error('description') inputError @enderror">{{old('description')}}</textarea>
                                @error('description')
                                    <div class="callout callout-danger bg-black mt-1 p-1">
                                        <p>{{$message}}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" name="hide" id="hide" {{old('hide') ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="hide">Скрыть</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" name="hide_18" id="hide_18" {{old('hide_18') ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="hide_18">Возрастное ограничение 18+</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Обложка</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input @error('image') is-invalid @enderror bg-dark" type="file" name="image" id="image">
                                        <label class="custom-file-label" for="image">Выбрать файл</label>
                                    </div>
                                </div>
                                @error('image')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="d-none d-sm-block">
                                <button class="btn btn-success" type="submit">Сохранить</button>
                            </div>
                        </div>
                        <div class="col-12 col-sm">
                            <div class="form-group">
                                <label for="types">Выберите тип</label>
                                <select class="form-control bg-black" name="id_type" id="types">
                                    @foreach(\App\Models\Type::all() as $type)
                                        <option
                                            @isset(old('id_type')->id)
                                                {{old('id_type')->id == $type->id ? 'selected' : ''}}
                                            @endisset
                                        value="{{$type->id}}">{{$type->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Выберите статус</label>
                                <select class="form-control bg-black" name="id_status" id="status">
                                    @foreach(\App\Models\Status::all() as $status)
                                        <option
                                            @isset(old('id_status')->id)
                                                {{old('id_status')->id== $status->id ? 'selected' : ''}}
                                            @endisset
                                        value="{{$status->id}}">{{$status->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Выберите теги</label>
                                <select class="select2 " multiple data-placeholder="Выберите теги" style="width: 100%;" name="id_tags[]" id="tags">
                                    @foreach(\App\Models\Tag::all() as $tag)
                                        <option {{collect(old('id_tags'))->contains($tag->id) ? 'selected' : ''}}                                         value="{{$tag->id}}">{{$tag->title}}</option>
                                    @endforeach
                                </select>
                                @error('id_tags')
                                    <div class="callout callout-danger bg-black mt-1 p-1">
                                        <p>{{$message}}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="genres">Выберите жанры</label>
                                <select class="select2" multiple data-placeholder="Выберите теги" style="width: 100%;" name="id_genres[]" id="genres">
                                    @foreach(\App\Models\Genre::all() as $genre)
                                        <option {{collect(old('id_genres'))->contains($genre->id) ? 'selected' : ''}} value="{{$genre->id}}">{{$genre->title}}</option>
                                    @endforeach
                                </select>
                                @error('id_genres')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-block d-sm-none col-12 col-sm">
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </div>
                </form>
                <div class="content mt-2 p-2">
                    <div class="row"><a class="btn btn-block btn-secondary" href="{{route('titles')}}" type="button" style="width: 100px;">Назад</a></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('add_script')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script>
    $(function () {
            bsCustomFileInput.init()
        })
        $('.select2').select2()

    </script>
@endsection
