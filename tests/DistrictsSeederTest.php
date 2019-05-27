<?php

use PHPUnit\Framework\TestCase;
use Overtrue\Pinyin\Pinyin;
use Illuminate\Support\Collection;

class DistrictsSeederTest extends TestCase
{
    public function testGetDistricts()
    {
        $pinyin = new Pinyin(); // 默认
        $context = file_get_contents('https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json');
        $nodes = json_decode($context);
        collect($nodes->children)->each(function ($node) use ($pinyin) {
            $res = $pinyin->permalink($node->name, '');
            $this->assertNotEmpty($res);
        });
    }
}
