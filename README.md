### Собрать базовый образ для unit:1.25.0-php7.4
```shell
git clone https://github.com/nginx/unit
cd unit
git checkout 1.25.0
cd pkg/docker/
make build-php7.4 VERSION_php=7.4
```

### Deploy

Клонируем репозиторий и копируем .env.example в .env \
Заходим в папку deployment и запускаем контейнеры
```shell
docker-compose -p stock -f docker-compose.dev.yml up -d
```

Поднимется небольшой контейнер с Lumen внутри и отдельный контейнер с mysql. \
Чтобы проверить работу нужно зайти в контейнер, запустить миграцию, заполнить таблицы поставок и склада.
```shell
docker exec -it stock.core-service bash
cd /var/www
composer install
php artisan migrate
php artisan db:seed
php artisan service:fill-stock-history
```

После этого локально на порту 8080 можно покликать всякое
