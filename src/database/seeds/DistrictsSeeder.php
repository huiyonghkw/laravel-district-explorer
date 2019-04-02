<?php

namespace Bravist\DistrictExplorer\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $this->grapDistricts();
    }


    private function grapDistricts()
    {
        $context = file_get_contents('https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json');
        $nodes = json_decode($context);

        collect($nodes->children)->each(function ($node) {
            $this->insert($node->adcode, $node->name, $node->level, $node->acroutes[0], $node->center[0], $node->center[1]);
            if ($node->children) {
                collect($node->children)->each(function ($children) {
                    $this->insert($children->adcode, $children->name, $children->level, $children->provCode, $children->center[0], $children->center[1]);
                });
            }
        });
    }

    private function insert($adcode, $name, $level, $parent, $longitude, $latitude)
    {
        DB::table('districts')
            ->insert([
                'adcode' => $adcode,
                'name' => $name,
                'level' => $level,
                'parent_code' => $parent,
                'center_longitude' => $longitude,
                'center_latitude' => $latitude,
            ]);
    }
}
