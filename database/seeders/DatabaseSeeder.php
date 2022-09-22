<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Manga;
use App\Models\MangaGenre;
use App\Models\MangaTag;
use App\Models\Scans;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function create_types()
    {
        Type::factory()->create(['title' => 'Манга',]);
        Type::factory()->create(['title' => 'Maнхва',]);
        Type::factory()->create(['title' => 'Маньхуа',]);
    }

    public function create_status()
    {
        Status::factory()->create(['title' => 'Закончен',]);
        Status::factory()->create(['title' => 'Продолжается',]);
        Status::factory()->create(['title' => 'Заморожен',]);
        Status::factory()->create(['title' => 'Анонс',]);
        Status::factory()->create(['title' => 'Лицензировано',]);
    }

    public function create_genres()
        {
            Genre::factory()->create(['title' => 'Боевик',]);
            Genre::factory()->create(['title' => 'Боевые искусства',]);
            Genre::factory()->create(['title' => 'Гарем',]);
            Genre::factory()->create(['title' => 'Гендерная интрига',]);
            Genre::factory()->create(['title' => 'Героическое фэнтези',]);
            Genre::factory()->create(['title' => 'Детектив',]);
            Genre::factory()->create(['title' => 'Дзёсэй',]);
            Genre::factory()->create(['title' => 'Додзинси',]);
            Genre::factory()->create(['title' => 'Драма',]);
            Genre::factory()->create(['title' => 'Игра',]);
            Genre::factory()->create(['title' => 'История',]);
            Genre::factory()->create(['title' => 'Киберпанк',]);
            Genre::factory()->create(['title' => 'Кодомо',]);
            Genre::factory()->create(['title' => 'Комедия',]);
            Genre::factory()->create(['title' => 'Махо-сёдзё',]);
            Genre::factory()->create(['title' => 'Меха',]);
            Genre::factory()->create(['title' => 'Мистика',]);
            Genre::factory()->create(['title' => 'Мурим',]);
            Genre::factory()->create(['title' => 'Научная фантастика',]);
            Genre::factory()->create(['title' => 'Повседневность',]);
            Genre::factory()->create(['title' => 'Постапокалиптика',]);
            Genre::factory()->create(['title' => 'Приключения',]);
            Genre::factory()->create(['title' => 'Психология',]);
            Genre::factory()->create(['title' => 'Романтика',]);
            Genre::factory()->create(['title' => 'Сверхъестественное',]);
            Genre::factory()->create(['title' => 'Сёдзё',]);
            Genre::factory()->create(['title' => 'Сёдзё-ай',]);
            Genre::factory()->create(['title' => 'Сёнэн',]);
            Genre::factory()->create(['title' => 'Сёнэн-ай',]);
            Genre::factory()->create(['title' => 'Спорт',]);
            Genre::factory()->create(['title' => 'Сэйнэн',]);
            Genre::factory()->create(['title' => 'Трагедия',]);
            Genre::factory()->create(['title' => 'Триллер',]);
            Genre::factory()->create(['title' => 'Ужасы',]);
            Genre::factory()->create(['title' => 'Фантастика',]);
            Genre::factory()->create(['title' => 'Фэнтези',]);
            Genre::factory()->create(['title' => 'Школа',]);
            Genre::factory()->create(['title' => 'Элементы юмора',]);
            Genre::factory()->create(['title' => 'Эротика',]);
            Genre::factory()->create(['title' => 'Этти',]);
            Genre::factory()->create(['title' => 'Юри',]);
        }

    public function create_tags()
    {
        Tag::factory()->create(['title' => 'Азартные игры']);
        Tag::factory()->create(['title' => 'Алхимия']);
        Tag::factory()->create(['title' => 'Амнезия']);
        Tag::factory()->create(['title' => 'Амнезия/Потеря памяти']);
        Tag::factory()->create(['title' => 'Ангелы']);
        Tag::factory()->create(['title' => 'Антигерой']);
        Tag::factory()->create(['title' => 'Антиутопия']);
        Tag::factory()->create(['title' => 'Апокалипсис']);
        Tag::factory()->create(['title' => 'Армия']);
        Tag::factory()->create(['title' => 'Артефакты']);
        Tag::factory()->create(['title' => 'Боги']);
        Tag::factory()->create(['title' => 'Бои на мечах']);
        Tag::factory()->create(['title' => 'Борьба за власть']);
        Tag::factory()->create(['title' => 'Брат и сестра']);
        Tag::factory()->create(['title' => 'Будущее']);
        Tag::factory()->create(['title' => 'Ведьма']);
        Tag::factory()->create(['title' => 'Вестерн']);
        Tag::factory()->create(['title' => 'Видеоигры']);
        Tag::factory()->create(['title' => 'Виртуальная реальность']);
        Tag::factory()->create(['title' => 'Владыка демонов']);
        Tag::factory()->create(['title' => 'Военные']);
        Tag::factory()->create(['title' => 'Война']);
        Tag::factory()->create(['title' => 'Волшебники/маги']);
        Tag::factory()->create(['title' => 'Волшебные существа']);
        Tag::factory()->create(['title' => 'Воспоминания из другого мира']);
        Tag::factory()->create(['title' => 'Выживание']);
        Tag::factory()->create(['title' => 'ГГ женщина']);
        Tag::factory()->create(['title' => 'ГГ имба']);
        Tag::factory()->create(['title' => 'ГГ мужчина']);
        Tag::factory()->create(['title' => 'Геймеры']);
        Tag::factory()->create(['title' => 'Гильдии']);
        Tag::factory()->create(['title' => 'Глупый ГГ']);
        Tag::factory()->create(['title' => 'Гоблины']);
        Tag::factory()->create(['title' => 'Горничные']);
        Tag::factory()->create(['title' => 'Гяру']);
        Tag::factory()->create(['title' => 'Демоны']);
        Tag::factory()->create(['title' => 'Драконы']);
        Tag::factory()->create(['title' => 'Дружба']);
        Tag::factory()->create(['title' => 'Жестокий мир']);
        Tag::factory()->create(['title' => 'Животные компаньоны']);
        Tag::factory()->create(['title' => 'Завоевания мира']);
        Tag::factory()->create(['title' => 'Зверолюди']);
        Tag::factory()->create(['title' => 'Злые духи']);
        Tag::factory()->create(['title' => 'Зомби']);
        Tag::factory()->create(['title' => 'Игровые элементы']);
        Tag::factory()->create(['title' => 'Империи']);
        Tag::factory()->create(['title' => 'Квесты']);
        Tag::factory()->create(['title' => 'Космос']);
        Tag::factory()->create(['title' => 'Кулинария']);
        Tag::factory()->create(['title' => 'Культивация']);
        Tag::factory()->create(['title' => 'Легендарное оружие']);
        Tag::factory()->create(['title' => 'Лоли']);
        Tag::factory()->create(['title' => 'Магическая академия']);
        Tag::factory()->create(['title' => 'Магия']);
        Tag::factory()->create(['title' => 'Мафия']);
        Tag::factory()->create(['title' => 'Медицина']);
        Tag::factory()->create(['title' => 'Месть']);
        Tag::factory()->create(['title' => 'Монстродевушки']);
        Tag::factory()->create(['title' => 'Монстры']);
        Tag::factory()->create(['title' => 'Музыка']);
        Tag::factory()->create(['title' => 'Навыки']);
        Tag::factory()->create(['title' => 'Насилие/жестокость']);
        Tag::factory()->create(['title' => 'Наемники']);
        Tag::factory()->create(['title' => 'Нежить']);
        Tag::factory()->create(['title' => 'Ниндзя']);
        Tag::factory()->create(['title' => 'Обмен телами']);
        Tag::factory()->create(['title' => 'Обратный гарем']);
        Tag::factory()->create(['title' => 'Огнестрельное оружие']);
        Tag::factory()->create(['title' => 'Офисные работники']);
        Tag::factory()->create(['title' => 'Пародия']);
        Tag::factory()->create(['title' => 'Пираты']);
        Tag::factory()->create(['title' => 'Подземелья']);
        Tag::factory()->create(['title' => 'Политика']);
        Tag::factory()->create(['title' => 'Полиция']);
        Tag::factory()->create(['title' => 'Преступники/Криминал']);
        Tag::factory()->create(['title' => 'Призраки/Духи']);
        Tag::factory()->create(['title' => 'Путешествие во времени']);
        Tag::factory()->create(['title' => 'Рабы']);
        Tag::factory()->create(['title' => 'Разумные расы']);
        Tag::factory()->create(['title' => 'Ранги силы']);
        Tag::factory()->create(['title' => 'Реинкарнация']);
        Tag::factory()->create(['title' => 'Роботы']);
        Tag::factory()->create(['title' => 'Рыцари']);
        Tag::factory()->create(['title' => 'Самураи']);
        Tag::factory()->create(['title' => 'Система']);
        Tag::factory()->create(['title' => 'Скрытие личности']);
        Tag::factory()->create(['title' => 'Спасение мира']);
        Tag::factory()->create(['title' => 'Спортивное тело']);
        Tag::factory()->create(['title' => 'Средневековье']);
        Tag::factory()->create(['title' => 'Стимпанк']);
        Tag::factory()->create(['title' => 'Супергерои']);
        Tag::factory()->create(['title' => 'Традиционные игры']);
        Tag::factory()->create(['title' => 'Умный ГГ']);
        Tag::factory()->create(['title' => 'Учитель/ученик']);
        Tag::factory()->create(['title' => 'Философия']);
        Tag::factory()->create(['title' => 'Хикикомори']);
        Tag::factory()->create(['title' => 'Холодное оружие']);
        Tag::factory()->create(['title' => 'Шантаж']);
        Tag::factory()->create(['title' => 'Эльфы']);
        Tag::factory()->create(['title' => 'Якудзе']);
        Tag::factory()->create(['title' => 'Япония']);
    }

    public function create_mangas() {
        Manga::factory()->create([
            'title_eng' => 'Rent-a-Girlfriend',
            'title_ru' => 'Девушка на час',
            'title_korean' => 'Kanojo, okarishimasu',
            'text' => 'Киносита Кадзуя – обычный студент университета, которого девушка только что бросила ради другого парня. Чувствуя себя ниже плинтуса, он решает воспользоваться приложением «Diamond», наняв Мидзухару Чизуру, девушку на час, чтобы почувствовать себя лучше. По первому впечатлению она идеальная девушка, но правда ли она такая, какой кажется? И как будут развиваться их не совсем обычные отношения?',
            'censor' => 0,
            'id_type' => 1,
            'id_status' => 3,
        ]);
        Manga::factory()->create([
            'title_eng' => 'Wind Breaker',
            'title_ru' => 'Ветролом',
            'title_korean' => '',
            'text' => 'Ветролом — драма о юных уличных гонщиках, мечтающих о свободе. Главный герой — Джа Хён — сын успешных родителей и лучший ученик в своей школе. Он никогда не знал, что значит «бороться за свою мечту», ведь вся его жизнь определялась родителями, которые хотят для сына только одного — успешного окончания школы. Но однажды Джа Хён, с детства любящий велоспорт, оказывается втянут в деятельность местных гонщиков, что заставляет героя пересмотреть приоритеты родителей и прислушаться к себе, ведь на своем новом пути он обретает друзей, любовь и приключения.',
            'censor' => 0,
            'id_type' => 2,
            'id_status' => 1,
        ]);
        Manga::factory()->create([
            'title_eng' => 'Lol',
            'title_ru' => 'Лол',
            'title_korean' => 'loool',
            'text' => 'Хз что писать',
            'censor' => 1,
            'id_type' => 1,
            'id_status' => 4,
        ]);
        Manga::factory()->create([
            'title_eng' => 'манга 1',
            'title_ru' => 'манга 1',
            'title_korean' => 'lorem',
            'text' => 'Хз что писать',
            'censor' => 1,
            'id_type' => 2,
            'id_status' => 1,
        ]);
        Manga::factory()->create([
            'title_eng' => 'манга 2',
            'title_ru' => 'манга 2',
            'title_korean' => 'lorem',
            'text' => 'Хз что писать',
            'censor' => 1,
            'id_type' => 1,
            'id_status' => 2,
        ]);
    }

    public function create_chapters(){
        Chapter::factory()->create([
            'id_manga' => 1,
            'tom' => 1,
            'number' => 1,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 1,
            'tom' => 1,
            'number' => 2,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 1,
            'tom' => 1,
            'number' => 3,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 1,
            'tom' => 2,
            'number' => 1,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 1,
            'tom' => 2,
            'number' => 2,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 1,
            'tom' => 2,
            'number' => 3,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 2,
            'tom' => 1,
            'number' => 1,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 2,
            'tom' => 1,
            'number' => 2,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 2,
            'tom' => 1,
            'number' => 3,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 2,
            'tom' => 2,
            'number' => 1,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 2,
            'tom' => 2,
            'number' => 2,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
        Chapter::factory()->create([
            'id_manga' => 2,
            'tom' => 2,
            'number' => 3,
            'premium_access' => random_int(0, 1),
            'date_of_free'=>Carbon::now()
        ]);
    }

    public function run()
    {
        $this->create_types();
        $this->create_status();
        $this->create_genres();
        $this->create_tags();
//        $this->create_mangas();
//        $this->create_chapters();
//        Scans::factory()->count(20)->create();
//        MangaGenre::factory()->count(10)->create()->unique();
//        MangaTag::factory()->count(10)->create()->unique();
        User::create([
            'nickname'=>'animila',
            'name'=>'Илья',
            'gender'=>'Мужской',
            'role'=>'admin',
            'email'=>'khristoforov-i@mail.ru',
            'password'=>Hash::make('123')]);
    }
}
