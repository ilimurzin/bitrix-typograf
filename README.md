# bitrix-typograf

Модуль для Битрикса. Добавляет типограф в визуальный редактор.

Модуль использует [Типограф на JavaScript](https://github.com/typograf/typograf).

## Установка

### Из Маркетплейса

Стандартная установка из Маркетплейса

https://marketplace.1c-bitrix.ru/solutions/ilimurzin.typograf/

### Композером

Добавить в `composer.json` вашего проекта

```json
{
    "extra": {
        "bitrix-dir": "www/bitrix"
    }
}
```

где `www/bitrix` — путь до директории bitrix.

Выполнить команду

```sh
composer require ilimurzin/bitrix-typograf
```

### После установки

В админке перейти в «Marketplace» → «Установленные решения» и нажать «Установить».
