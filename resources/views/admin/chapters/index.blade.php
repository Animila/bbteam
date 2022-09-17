<?php
date_default_timezone_set('Asia/Yakutsk');
    ?>
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
                        <h2 class="m-0">Список глав</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="content bg-black">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6 align-content-center"><a class="btn btn-block btn-danger btn-lg" href="{{route('chapter.create')}}" type="button">Добавить</a></div>
                </div>
                <div class="row mt-5 d-none d-sm-block">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th class="col-1">Id</th>
                            <th class="col-2">Манга</th>
                            <th class="col-1">Том</th>
                            <th class="col-1">Номер </th>
                            <th class="col-2">Название</th>
                            <th class="col-1">Время</th>
                            <th class="col-3">Премиум</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($content['chapters'] as $chapter)
                            <tr>
                                <th>{{$chapter->id}}</th>
                                <th><a class="nohover text-light" href="{{route('chapter.edit', $chapter->id)}}">{{$chapter->manga->title_ru}}</a></th>
                                <th>{{$chapter->tom}}</th>
                                <th>{{$chapter->number}}</th>
                                <th>{{$chapter->title}}</th>
                                <th>{{
                                     date_diff(date_create(), date_create($chapter->date_of_free))->format('%a дней %H:%I:%S')
                                    }}
                                </th>
                                <th>{{$chapter->premium_access ? 'Активен' : 'Не активен'}}</th>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row mt-5 d-block d-sm-none">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th class="col-1">Id</th>
                            <th class="col-2">Название</th>
                            <th class="col-2">Том</th>
                            <th class="col-2">Номер</th>
                            <th class="col-2">Время</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($content['chapters'] as $chapter)
                            <tr>
                                <th>{{$chapter->id}}</th>
                                <th><a class="nohover text-light" href="{{route('chapter.edit', $chapter->id)}}">{{$chapter->manga->title_ru}}</a></th>
                                <th>{{$chapter->tom}}</th>
                                <th>{{$chapter->number}}</th>
                                <th>{{
                                     date_diff(date_create(), date_create($chapter->date_of_free))->format('%a дней %H:%I:%S')
                                    }}
                                </th>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('add_script')
@endsection
