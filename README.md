### Deploy

Клонируем репозиторий и копируем .env.example в .env \
Заходим в папку deployment и запускаем контейнеры
```shell
docker-compose -p stock -f docker-compose.dev.yml up -d
```

Поднимется небольшой контейнер с Lumen внутри и отдельный контейнер с mysql.\
Чтобы проверить работу нужно зайти в контейнер, запустить миграцию, заполнить таблицы поставок и склада.
```shell
docker exec -it stock.core-service bash
cd /var/www
php artisan migrate
php artisan db:seed
php artisan service:fill-stock-history
```

После этого локально на порту 8080 можно покликать всякое
