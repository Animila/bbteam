<form action="{{route('auth')}}" method="post">
    @csrf
    Почта: <input type="email" name="email" placeholder="почта"><br>
    Пароль: <input type="password" name="password" placeholder="пароль"><br>
    Запомнить? <input type="checkbox" name="remember"><br>
    <a href="{{route('auth.social', 'vkontakte')}}">Авторизация по вк</a>

    <button type="submit">Сохранить</button>

</form>
