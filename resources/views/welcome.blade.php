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
        @foreach($chapter->scans as $scan)
            <img src="{{$scan->url}}" alt="" style="max-width: 20%">
        @endforeach
        <br>
        <hr>
        <br>
    @endforeach
    <br>
    </body>
</html>
