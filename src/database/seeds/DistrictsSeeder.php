<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Overtrue\Pinyin\Pinyin;

class DistrictsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->truncate();
        $this->grapDistricts();
    }


    public function grapDistricts()
    {
        $pinyin = new Pinyin(); // 默认

        $context = file_get_contents('https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json');
        $nodes = json_decode($context);

        collect($nodes->children)->each(function ($node) use ($pinyin) {
            $this->insert(
                            $node->adcode,
                            $node->name,
                            $pinyin->permalink($node->name, ''),
                            $node->level,
                            $node->acroutes[0],
                            $node->center[0],
                            $node->center[1]
                        );
            if (!empty($node->children)) {
                collect($node->children)->each(function ($children) use ($pinyin) {
                    $this->insert(
                                    $children->adcode,
                                    $children->name,
                                    $pinyin->permalink($children->name, ''),
                                    $children->level,
                                    $children->provCode,
                                    $children->center[0],
                                    $children->center[1]
                                );
                });
            }
        });
    }

    private function insert($adcode, $name, $pinyin, $level, $parent, $longitude, $latitude)
    {
        DB::table('districts')
            ->insert([
                'adcode' => $adcode,
                'name' => $name,
                'pinyin' => $pinyin,
                'level' => $level,
                'parent_code' => $parent,
                'center_longitude' => $longitude,
                'center_latitude' => $latitude,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }
}
