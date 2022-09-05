<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

    @auth()
        Авторизован
        <a href="{{route('logout')}}">Выйти</a>
        @if(! \App\Models\SocialAccount::where('user_id', auth()->id())->first())
            <a href="{{route('auth.social', 'vkontakte')}}">Авторизация по вк</a>
        @else
            <a href="{{route('auth.delete')}}">Отвязать</a>
        @endif
    @else
        <a href="{{route('login')}}">Логин</a>
        <a href="{{route('register')}}">Регистрация</a>
    @endauth


    <br>
    <br>
        Английский: {{$manga->title_eng}} <br>
        Русский:  {{$manga->title_ru}} <br>
        Корейский: {{$manga->title_korean}} <br>
        Описание: {{$manga->text}}<br>
        18+: {{$manga->censor}}<br>
        Статус: {{$manga->status->title}}<br>
        Тип: {{$manga->type->title}}<br>
        <br>
        теги:
        @foreach($manga->tags as $tag)
            {{$tag->title}}
        @endforeach
        <br>
        жанры:
        @foreach($manga->genres as $tag)
            {{$tag->title}}
        @endforeach
        <br>

        Главы: <br>
        @foreach($manga->chapters as $chapter)
            {{$chapter->title}}<br>
                <a href="{{route('manga.show.scans', [str_replace(' ', '_', $manga->title_eng), $chapter])}}">Посмотреть</a>
            <br>
            <hr>
            <br>
        @endforeach
        <br>
    </body>
</html>
