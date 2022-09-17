@extends('admin.layout.base')

@section('content')
    <div class="content-wrapper bg-black">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Статистика</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{\App\Models\Manga::all()->count()}}</h3>
                                <p>Количество тайтлов</p>
                            </div>
                            <div class="icon"><i class="ion ion-people"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{\App\Models\Chapter::all()->count()}}</h3>
                                <p>Количество глав</p>
                            </div>
                            <div class="icon"><i class="ion ion-bag"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>28000</h3>
                                <p>Количество просмотров</p>
                            </div>
                            <div class="icon"><i class="ion ion-stats-bars"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>9053</h3>
                                <p>Количество лайков</p>
                            </div>
                            <div class="icon"><i class="ion ion:people-sharp"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{\App\Models\User::where('created_at', '>=', Carbon\Carbon::now()->firstOfMonth()->toDateTimeString())->get()->count()}}</h3>
                                <p>Новые пользователи</p>
                            </div>
                            <div class="icon"><i class="ion ion-person-add"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{\App\Models\User::all()->count()}}</h3>
                                <p>Пользователи</p>
                            </div>
                            <div class="icon"><i class="ion ion-person-add"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{\App\Models\User::where('premium', true)->get()->count()}}</h3>
                                <p>Премиум пользователи</p>
                            </div>
                            <div class="icon"><i class="ion ion-pie-graph"></i></div><a class="small-box-footer" href="#">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

