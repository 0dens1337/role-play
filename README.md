# Установка и запуск проекта

## ⚙️ Установка

1. Скопируйте файл конфигурации окружения (Важно! не забудь указать свой GID и UID для группы докера, по дефолту это 1000):

```bash
cp .env.example .env
```

теперь запустите билд контейнеров:
```bash
docker compose up -d --build
```

запустите сами контейнеры:
```bash
docker compose up -d --remove-orphans
```

установка зависимостей и дополнительные шаги для настройки рабочего окружения Laravel, создание админа и Invite кода.
```bash
docker compose exec php bash composer install
```

```bash
docker compose exec php bash php artisan migrate
```

```bash
docker compose exec php bash php artisan tinker
```

```bash
docker compose exec php bash php artisan db:seed
```

Дополнительно: Если у вас Винда то нужно будет раскоментировать разрешение модуля gd в php.ini
