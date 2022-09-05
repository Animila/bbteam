Аккаунт

@if(auth()->user()->premium)
    Привязан
    <a href="{{route('premium.UNDONUT')}}">Отвязять VKDONUT</a>

@else
    <a href="{{route('premium.DONUT')}}">Привязать VKDONUT</a>
@endif

<a href="/">Назад</a>

