<form action="{{route('reg')}}" method="post">
    @csrf
    Никнейм: <input type="text" name="nickname" placeholder="Никнейм"><br>
    Имя: <input type="text" name="name" placeholder="имя"><br>
    Пол: <input type="text" name="gender" value="мужской"><br>
    Почта: <input type="email" name="email" placeholder="почта"><br>
    Пароль: <input type="password" name="password" placeholder="пароль"><br>
    Подтверждение пароля: <input type="password" name="password_confirmation" placeholder="повторить пароль"><br>

    <button type="submit">Сохранить</button>

</form>
