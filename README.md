# lumen-shops

> Демоснтрационная консольная команда микрофреймворка Lumen, выполняющая импорт данных в таблицу магазинов из файла .csv

## Запуск консольной команды

``` bash
# импорт данных из файла shops.csv:
php artisan shops:import shops.csv

# проверка состояния таблицы магазинов:
cd database
sqlite3 database.sqlite
sqlite> select * from shops;
. . .
sqlite> .exit
```