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
                        <h2>Создание нового тега</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper bg-black">
            <section class="content">
                <div class="container bg-dark p-2">
                    <form action="{{route('tags.store')}}"  method="post" enctype="multipart/form-data" id="userSetting">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nick">Название</label>
                                    <input class="form-control bg-black" type="text" placeholder="(необязательно)" name="title" value="{{old('title')}}" id="nick">
                                    <div class="callout callout-danger bg-black mt-1 p-1 d-none" id="error-nick"></div>
                                </div>

                                <div class="d-none d-sm-block">
                                    <input class="btn btn-success" type="submit" value="Сохранить">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-12 d-sm-none">
                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                    <div class="content mt-2 p-2">
                        <div class="row"><a class="btn btn-block btn-secondary" href="{{route('tags')}}" type="button" style="width: 100px;">Назад</a></div>
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

    </script>
@endsection
