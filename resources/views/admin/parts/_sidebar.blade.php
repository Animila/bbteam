<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><img class="img-circle elevation-2" src="{{asset('dist/img/default-150x150.png')}}" alt="User Image"></div>
            <div class="info"><a class="d-block" href="">Администратор</a></div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item"><a class="nav-link" href="{{route('statistics')}}"><i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Статистика</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('titles')}}"><i class="nav-icon fas fa-book"></i>
                        <p>Тайтлы</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('chapter')}}"><i class="nav-icon fas fa-book-open"></i>
                        <p>Главы</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('users')}}"><i class="nav-icon fas fa-user"></i>
                        <p>Пользователи</p></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon fas fa-comment"></i>
                        <p>Комментарии</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('tags')}}"><i class="nav-icon fas fa-tags"></i>
                        <p>Теги</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('genres')}}"><i class="nav-icon fas fa-book"></i>
                        <p>Жанры</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('main')}}"><i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Вернуться на сайт</p></a></li>
            </ul>
        </nav>
    </div>
</aside>
