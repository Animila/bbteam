<!DOCTYPE html>
<html lang="ru" onload="setInterval(window.clipboardData.setData(text))" oncontextmenu="return false" onselectstart="return false">
    @include('admin.parts._head')
    <body class="hold-transition sidebar-mini layout-fixed bg-black" id="lol" oncontextmenu="return false">
        <div class="wrapper bg-black">
            @include('admin.parts._preloader')
            @include('admin.parts._navbar')

            @include('admin.parts._sidebar')

            @yield('content')

            <footer class="main-footer bg-black"><strong>Сделано Animila</strong></footer>
            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>
        @include('admin.parts._links')
    </body>
</html>
