**Тестовое задание для CYBERZILLA-PRIVACY**

Развернуть панель управления пользователями, с регистрацией и авторизацией + CRUD.
 В базу данных добавить 100000 записей, каждая запись должна содержать 10 аттрибутов, 3 из 10 аттрибутов должны быть в связных таблицах.
 Все записи вывести списком в панель управления администратора. 10 первых записей (по порядку), вывести в панель пользователя (личный кабинет).

Для разворота используем:

`git clone https://github.com/depakespedro/cyberzilla`

`composer install`

`php artisan migrate --seed`

`php artisan serve`
