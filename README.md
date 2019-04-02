# bravist/laravel-district-explorer

## 名称与描述

District Explorer For Laravel with AutoNavi. 

中国行政区划数据，根据高德[行政区划浏览](https://lbs.amap.com/api/javascript-api/reference-amap-ui/geo/district-explorer)说明，访问[高德区划API](https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json)生成最新区划数据，支持动态更新最新区划数据。

## 表结构参考（自动创建）
```sql
CREATE TABLE `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区划编码',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区划名称',
  `pinyin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区划名称拼音',
  `level` enum('country','province','city','district') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区划级别',
  `parent_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '上级区划编码',
  `center_longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区划中心经度',
  `center_latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区划中心纬度',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_adcode_index` (`adcode`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```


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

生成最新区划数据（数据表在生成时会自动清空之前数据）。
```php
$ php artisan db:seed --class=DistrictsSeeder
```
## 测试说明

单元测试。

```php
 $ ./vendor/bin/phpunit --filter DistrictsSeederTest
```
