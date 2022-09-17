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
                        <h2>{{$content['manga']->title_ru}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container bg-dark p-2">
                <form action="{{route('titles.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-12 col-sm-3"><img class="d-block mx-auto mb-3 w-100" src="{{asset('storage/'.$content['manga']->images()->where('type', 'title')->first()->url)}}" alt=""></div>
                        <div class="col-12 col-sm">
                            <div class="form-group">
                                <label for="title_ru">Русское название</label>
                                <input class="form-control bg-black @error('title_ru') is-invalid @enderror" type="text" placeholder="(обязательно)" name="title_ru" value="{{$content['manga']->title_ru}}" id="title_ru @error('title_ru') inputError @enderror">
                                @error('title_ru')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_eng">Английское название</label>
                                <input class="form-control bg-black @error('title_eng') is-invalid @enderror" type="text" placeholder="(обязательно)" name="title_eng" value="{{$content['manga']->title_eng}}" id="title_eng @error('title_eng') inputError @enderror">
                                @error('title_eng')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_kor">Корейское название</label>
                                <input class="form-control bg-black @error('title_korean') is-invalid @enderror" type="text" placeholder="(необязательно)" name="title_korean" value="{{$content['manga']->title_korean}}" id="title_korean @error('title_korean') inputError @enderror">
                                @error('title_korean')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="about">Описание</label>
                                <textarea class="form-control bg-black @error('description') is-invalid @enderror" rows="3" placeholder="(обязательно)" name="description" id="about @error('description') inputError @enderror">{{$content['manga']->text}}</textarea>
                                @error('description')
                                <div class="callout callout-danger bg-black mt-1 p-1">
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <input value="{{$content['manga']->id}}" name="id_manga" type="hidden">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input {{$content['manga']->hide ? 'checked' : ''}} class="custom-control-input" type="checkbox" name="hide" id="hide">
                                    <label class="custom-control-label" for="hide">Скрыть</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input {{$content['manga']->censor ? 'checked' : ''}} class="custom-control-input" type="checkbox" name="hide_18" id="hide_18">
                                    <label class="custom-control-label" for="hide_18">Возрастное ограничение 18+</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Обложка</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input bg-dark" type="file" name="image" id="image">
                                        <label class="custom-file-label" for="image">Выбрать файл</label>
                                    </div>
                                    @error('image')
                                    <div class="callout callout-danger bg-black mt-1 p-1">
                                        <p>{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-none d-sm-block">
                                <button class="btn btn-success" type="submit">Сохранить</button>
                                <a class="btn btn-danger" onclick="document.getElementById('delete').submit();">Удалить</a>

                            </div>
                        </div>
                        <div class="col-12 col-sm">
                            <div class="form-group">
                                <label for="types">Тип</label>
                                <select class="form-control bg-black" name="id_type" id="types">
                                    @foreach(\App\Models\Type::all() as $type)
                                        <option {{$content['manga']->type == $type ? 'selected' : ''}} value="{{$type->id}}">{{$type->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select class="form-control bg-black" name="id_status" id="status">
                                    @foreach(\App\Models\Status::all() as $status)
                                        <option {{$content['manga']->status == $status ? 'selected' : ''}} value="{{$status->id}}">{{$status->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Теги </label>
                                <select class="select2" multiple data-placeholder="Выберите теги" style="width: 100%;" name="id_tags[]" id="tags">
                                    @foreach(\App\Models\Tag::all() as $tag)
                                        <option
                                            @foreach($content['manga']->tags as $tag_manga)
                                            {{$tag_manga->id== $tag->id ? 'selected' : ''}}
                                            @endforeach
                                            value="{{$tag->id}}">{{$tag->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gunres">Жанры</label>
                                <select class="select2" multiple data-placeholder="Выберите теги" style="width: 100%;" name="id_genres[]" id="gunres">

                                    @foreach(\App\Models\Genre::all() as $genre)
                                        <option
                                            @foreach($content['manga']->genres as $genre_manga)
                                                {{$genre_manga->id== $genre->id ? 'selected' : ''}}
                                            @endforeach
                                                value="{{$genre->id}}">{{$genre->title}}</option>
                                    @endforeach

                                </select>
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
    <form action="{{route('titles.delete', $content['manga']->id)}}" method="post" id="delete">
        @method('delete')
        @csrf
    </form>
@endsection

@section('add_script')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script>
        $(function () {

        })
    $(function () {
            bsCustomFileInput.init()
        })
        $('.select2').select2()

    </script>
@endsection
