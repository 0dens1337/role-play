# Установка и запуск проекта

## ⚙️ Установка

1. Скопируйте файл конфигурации окружения (Важно! не забудь указать свой GID и UID для группы докера):

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

установка зависимостей и дополнительные шаги для настройки рабочего окружения Laravel, создание админа.
```bash
docker exec -it php composer install
```

```bash
docker exec -it php php artisan migrate
```

```bash
docker exec -it php php artisan tinker
```

```bash
User::create(['login' => 'admin_1', 'email' => 'admin@mail.ru', 'role' => 3, 'password' => bcrypt('вставь_свой_пароль')])
```

```bash
docker exec -it php php artisan passport:client --personal
```
