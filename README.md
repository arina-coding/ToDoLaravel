
```markdown
# To-Do App на Laravel

Приложение для управления задачами с авторизацией, AJAX, REST API, анимированным звёздным фоном и тестами.

## Возможности

- Регистрация и вход (Laravel Breeze)
- Создание, редактирование, удаление задач
- Категории: Личное, Работа, Учёба
- Фильтры и поиск по названию и тексту
- Пагинация
- AJAX: переключение статуса, удаление, живой поиск — без перезагрузки
- REST API с токенами (Sanctum)
- Анимированный звёздный фон (Canvas)
- Адаптивная вёрстка
- Тесты (PHPUnit)
- Docker (PHP-FPM, Nginx, MySQL)

## Стек

- **Backend:** PHP 8.1, Laravel 10
- **База данных:** MySQL
- **Frontend:** Blade, CSS, JavaScript (fetch, DOM, Canvas)
- **DevOps:** Docker, Docker Compose
- **Тесты:** PHPUnit
- **Аутентификация:** Laravel Breeze
- **API:** Laravel Sanctum

## Установка

### Локально (OSPanel / XAMPP)

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/arina-coding/ToDoLaravel.git
   cd ToDoLaravel
   ```

2. Установить зависимости:
   ```bash
   composer install
   ```

3. Создать `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Настроить базу данных в `.env`:
   ```
   DB_DATABASE=todo_laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Создать базу данных и запустить миграции:
   ```bash
   php artisan migrate
   ```

6. Запустить сервер:
   ```bash
   php artisan serve
   ```

7. Открыть http://127.0.0.1:8000

### Через Docker

1. Установить Docker Desktop
2. Запустить контейнеры:
   ```bash
   docker-compose up -d
   ```
3. Открыть http://127.0.0.1:8000

## Тесты

```bash
php artisan test
```

