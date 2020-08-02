Предпологается что Git, Docker и Docker-compose установлены.

Запускаем сборку и наслаждаемся мультиком:
docker-compose up --build

Заходим в контейнер app:
docker exec -it app /bin/bash

Делаем миграции:
php bin/console doctrine:migrations:migrate


Доступные команды можно посмотреть в консоли в разделе app:
php bin/console
