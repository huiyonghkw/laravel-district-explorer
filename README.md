# bravist/laravel-district-explorer

## 名称与描述

District Explorer For Laravel with AutoNavi. 

中国行政区划数据，访问[高德区划API](https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json)获取最新区划数据。支持动态更新最新区划数据。

## 安装说明

```php
$ composer require bravist/laravel-district-explorer -vvv
```

## 使用说明

生成migrations。
```php
$ php artisan vendor:publish --provider="Bravist\DistrictExplorer\DistrictExplorerServiceProvider"
```

执行migrate。

```php
$ php artisan migrate
```

加载Seeder。
```php
$ composer dump-autoload
```

## 测试说明

单元测试

```php
 $ ./vendor/bin/phpunit --filter DistrictsSeederTest
```
