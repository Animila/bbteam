@extends('admin.layout.base')

@section ('add_link')
@endsection

@section('content')
    <div class="content-wrapper bg-black">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
        <section class="content-header bg-black">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Список тайтлов</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="content bg-black">
            <div class="container">
                <div class="card">
                    <div class="card-header bg-dark">
                        <a class="btn btn-block btn-danger btn-sm card-title d-none d-sm-block w-25" href="{{route('titles.create')}}" type="button">Добавить</a>
                        <a class="btn btn-block btn-danger btn-sm card-title d-block d-sm-none w-100 my-1" href="{{route('titles.create')}}" type="button">Добавить</a>

                        <div class="card-tools bg-dark align-middle">
                            @if((new \Jenssegers\Agent\Agent())->isDesktop())
                                <div class="input-group input-group-sm my-1" style="width: 150px;">
                            @endif
                            @if((new \Jenssegers\Agent\Agent())->isMobile())
                                <div class="input-group input-group-sm my-1 w-100">
                            @endif
                                <input class="form-control float-right" type="text" name="table_search" placeholder="Поиск">
                                <div class="input-group-append">
                                    <button class="btn btn-default bg-dark" type="submit"><i class="fas fa-search bg-dark"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0 bg-dark">
                        <table class="table table-hover table-dark row mt-5 d-none d-lg-block">
                            <thead>
                            <tr>
                                <th class="col-1">Id</th>
                                <th class="col-2">Русское название</th>
                                <th class="col-1">Возрастной рейтинг </th>
                                <th class="col-1">Тип</th>
                                <th class="col-1">Статус </th>
                                <th class="col-3">Теги </th>
                                <th class="col-3">Жанры </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content['manga'] as $manga)
                                <tr>
                                    <th>{{$manga->id}}</th>
                                    <th><a class="nohover text-light" href="{{route('titles.edit', $manga->id)}}">{{$manga->title_ru}}</a></th>
                                    <th>{{$manga->censor ? '+' : '-'}}</th>
                                    <th>{{$manga->type->title}}</th>
                                    <th>{{$manga->status->title}}</th>
                                    <th>
                                        @foreach($manga->tags as $tag)
                                            <a class="btn btn-secondary btn-sm m-1">{{$tag->title}}</a>
                                        @endforeach
                                    </th>

                                    <th>
                                        @foreach($manga->genres as $genre)
                                            <a class="btn btn-secondary btn-sm m-1">{{$genre->title}}</a>
                                        @endforeach
                                    </th>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <div class="row mt-5 d-block d-lg-none">
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr>
                                    <th class="col-1">Id</th>
                                    <th class="col-2">Название</th>
                                    <th class="col-1">Тип</th>
                                    <th class="col-1">Статус </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($content['manga'] as $manga)
                                    <tr>
                                        <th class="col-1 ">{{$manga->id}}</th>
                                        <th><a class="nohover text-light" href="{{route('titles.edit', $manga->id)}}">{{$manga->title_ru}}</a></th>
                                        <th>{{$manga->type->title}}</th>
                                        <th>{{$manga->status->title}}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
@endsection

@section('add_script')
@endsection
