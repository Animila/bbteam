<nav class="main-header navbar navbar-expand navbar-white navbar-dark d-flex justify-content-between bg-black">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
            <form action="{{route('logout')}}" method="POST">
                <button class="btn btn-outline-secondary" type="submit">Выйти из аккаунта</button>
            </form>
        </li>
    </ul>
</nav>
