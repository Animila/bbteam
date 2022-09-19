@extends('admin.layout.base')

@section ('add_link')
@endsection

@section('content')
    <div class="content-wrapper bg-black">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Теги</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper bg-black">
            <section class="content bg-black">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-4 align-content-center mb-6"><a class="btn btn-block btn-danger btn-lg" href="{{route('tags.create')}}" type="button">Добавить</a></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-black">
                                    <h3 class="card-title">Список тегов</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input class="form-control float-right" type="text" name="table_search" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-nohover text-nowrap bg-dark">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Тег</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($content['tags'] as $tag)
                                            <tr>
                                                <td>{{$tag->id}}</td>
                                                <td >{{$tag->title}}</td>

                                                <td class="d-flex justify-content-evenly">
                                                    <a class="btn nohover bg-dark" href="{{route('tags.edit', $tag->id)}}"><i class="fas fa-edit"></i></a>
                                                    <form action="{{route('tags.delete', $tag->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn nohover bg-dark" type="submit"><i class="fas fa-trash bg-black"></i></button>
                                                    </form>
                                                </td>
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
    </div>
@endsection

@section('add_script')
@endsection
