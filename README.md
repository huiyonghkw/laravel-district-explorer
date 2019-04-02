# bravist/laravel-district-explorer

## 名称与描述

District Explorer For Laravel with AutoNavi. 

中国行政区划数据，访问高德在线数据获取最新区划数据。

## 安装说明

```php
$composer install bravist/laravel-district-explorer -vvv
```

## 使用说明

生成migrations。
```php
$php artisan vendor:publish --provider="Bravist\District\DistrictExplorerServiceProvider"
```

执行migrate。

```php
$php artisan migrate
```

## 测试说明

单元测试

```php
 $./vendor/bin/phpunit --filter DistrictsSeederTest
```
