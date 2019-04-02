<?php

use PHPUnit\Framework\TestCase;
use Bravist\DistrictExplorer\Database\Seeds\DistrictsSeeder;

class DistrictsSeederTest extends TestCase
{
    public function testGetDistricts()
    {
        $res = (new DistrictsSeeder())->run();
        $this->assertObjectHasAttribute('userId', $res);
    }
}
