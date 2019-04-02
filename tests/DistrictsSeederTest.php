<?php

use PHPUnit\Framework\TestCase;
use Bravist\DistrictExplorer\Database\Seeds\DistrictsSeeder;

class DistrictsSeederTest extends TestCase
{
    public function testGetDistricts()
    {
        //         $context = file_get_contents('https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json');
        // $country = json_decode($context, true);
        // dd($country);

        $res = (new DistrictsSeeder())->run();
        $this->assertObjectHasAttribute('userId', $res);
    }
}
