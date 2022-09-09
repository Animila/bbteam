# Документация

## 1. Статусы пользователей
###Гость (guest)
Не имеет никаких привилегий на сайте, разрешен доступ только к главной странице, авторизации, регистрации, каталогу, новым проектам, информации о тайтле 
###Пользователь (auth)
Имеет доступ к личному кабинету, просмотр бесплатных глав, оставлять лайки, комментарии, закладки.

Доступные поля:

| Название          |     Поле     | Тип ответа |             Тип |
|-------------------|:------------:|-----------:|----------------:|
| Никнейм           | **nickname** |     string |    обязательное |
| Имя               |   **name**   |     string |    обязательное |
| Почта             |  **email**   |     string |    обязательное |
| Пароль            | **password** |     string | Необязательное* |
| Пол               |  **gender**  |     string |    обязательное |
| О себе            |  **about**   |       text |  Необязательное |
| Сокрытие 18+      | **hide_18**  |    integer |  Необязательное |
| Доступ к премиуму | **premium**  |    integer |    обязательное |
| Статус            |   **role**   |     string |    обязательное |


> *При авторизации с помощью соц сетей поле пароля не обязательное, но при авторизации может выскочить ошибка (исправить!). ОБЯЗАТЕЛЬНО ХЭШИРОВАТЬ ПРИ ПРОВЕРКЕ ИЛИ ИЗМЕНЕНИИ


###Премиум-пользователь (premium)
Имеет доступ к премиум главам.

**Как узнать статус?**
1. ```auth()->user()->premium ``` - вернет 0 или 1
2. ```Gate:check(‘for_premium_user’)``` вернет false или true
###Администратор (admin)
**Как узнать статус?**
1. ```auth()->user()->role``` - вернет ‘user’ или ‘admin’
2. ```Gate:check(‘for_admin_user’)``` - вернет false или true

## Работа API
> ВНИМАНИЕ! ДЛЯ РАБОТЫ С НЕКОТОРЫМИ ФУНКЦИЯМИ ТРЕБУЕТСЯ АВТОРИЗАЦИЯ
>
> [см. Аутентификация по API](#authApi)


Пример работы с API:
### ```http://bbteam.ru/api/getMangas?search=1&tags[]=1&tags[]=2```

###Список методов 
| Название                     |         Вызов         | Auth()? |                                                        Аргументы |
|------------------------------|:---------------------:|--------:|-----------------------------------------------------------------:|
| **ТАЙТЛЫ**                   |
| Список тайтлов               |     [**getMangas**]()     |       - |                                                                - |
| Список тайтлов с фильтрацией | [**getMangas.filters**](#filters) |       - | search, types[], <br/>status[], censor[],<br/> tags[], genres[]  |
| Информация о тайтле          |     [getManga](#getManga)      |       - |                                                            manga |
| Список глав в тайтле         |  [**getListChapters**](#getListChapters)  |       - |                                                            manga |
| Отобразить главу             |    [**getChapter**](#getChapter)     | premium |                                                          chapter |
| **ТЕГИ**                     |
| Отобразить список тегов      |      **getTags**      |       - |                                                                - |
| Создать новый тег            |     **setNewTag**     |   admin |                                                            title |
| Изменить тег                 |      **setTag**       |   admin |                                                        id, title |
| **ЖАНРЫ**                    |
| Отобразить список жанров     |     **getGenres**     |       - |                                                                - |
| Создать новый жанр           |     **setNewTag**     |   admin |                                                            title |
| Изменить жанр                |      **setTag**       |   admin |                                                        id, title |

## - <a id="getMangas" />```getMangas```
####Описание:
Возвращает список всех тайтлов.
####Аргументы :
- отсуствуют
#### JSON ответ:
Возыращает массив с данными тайтлов. См. [```getManga```]():

## - <a id="filters" />```getMangas.filters```
####Описание:
Возвращает список всех тайтлов.
####Аргументы :
- ```search``` - поиск по заголовкам и описанию
- ```types[]``` - тип тайтла
- ```status[]``` - статус перевода
- ```censor[]``` - список тайтлов по ограничению:
- ```tags[]``` - список тайтлов по тегам
- ```genres[]``` - список тайтлов по жанрам
#### JSON ответ:
Возыращает массив с данными тайтлов. См. [```getManga```]():

## - <a id="getManga" />```getManga```
####Описание:
Возвращает информацию о текущем тайтле
####Аргументы :
```manga``` - идентификатор тайтла
#### JSON ответ:
| Ключ                 |   Тип   |       Статус |            Описание |
|----------------------|:-------:|-------------:|--------------------:|
| ```[id]```           | integer |   обязателен |           ID тайтла |
| ```[title_eng]```    | string  |   обязателен | Английское название |
| ```[title_ru]```     | string  |   обязателен |    Русское название |
| ```[title_korean]``` | string  | необязателен |  Корейское название |
| ```[text]```         |  text   |   обязателен |     Описание тайтла |
| ```[censor]```       | boolean |   обязателен |  Возрастной рейтинг |
| ```[type]```         | string  |   обязателен |           Тип манги |
| ```[status]```       | string  |   обязателен |     Статус перевода |

## - <a id="getListChapters" />```getListChapters```
####Описание:
Возвращает список глав тайтла
####Аргументы :
manga - идентификатор тайтла
#### JSON ответ:
| Ключ            |   Тип   |       Статус |       Описание |
|-----------------|:-------:|-------------:|---------------:|
| ```[id]```      | integer |   обязателен |       ID главы |
| ```[tom]```     | integer |   обязателен |     Номер тома |
| ```[number]```  | integer |   обязателен |    Номер главы |
| ```[title]```   | string  | необязателен | Название главы |
| ```[premium]``` | boolean |   обязателен |    Доступность |

## - <a id="getChapter" />```getChapter```
####Описание:
Возвращает список сканов
####Аргументы :
chapter - айди главы
#### JSON ответ:
| Ключ            |   Тип   |       Статус |               Описание |
|-----------------|:-------:|-------------:|-----------------------:|
| ```[id]```      | integer |   обязателен |             Айди главы |
| ```[url]```     | string  |   обязателен |  Ссылка на изображение |
| ```[number]```  | integer |   обязателен | Порядковый номер скана |

### <a id="authApi" />Аутентификация по API
Для обеспечения работоспособности некоторых функций, API потребуется данные о пользователе, который отправляет запрос. Поэтому наш сервис использует технологию [Sanctum](https://laravel.com/docs/8.x/sanctum#authorizing-private-broadcast-channels), которая сохраняет уникальный ключ авторизации в куках сайта. Поэтому для работы вне сайта, требуется знать как подключаться к API.

**Инструкция для авторизации**
1. Посылаем запрос в [/sanctum/csrf-cookie]() для получения нового CSRF-токена
2. Авторизуемся [/auth?email={почта}&password={пароль}]() ((опционально) для сохранения сессии - [remember=true]())
   1. Параметры: _email_, _password_ 
   2. Header: _X-XSRF-TOKEN_
3. И для последующих запросов ОБЯЗАТЕЛЬНО добавляем в Header ключ Referer со значением имени домена из конфигуратора config/sanctum


