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
        $this->insert(
            $nodes->adcode,
            $nodes->name,
            $pinyin->permalink($nodes->name, ''),
            $nodes->level,
            0,
            $nodes->center[0],
            $nodes->center[1]
        );
        $countryCode = $nodes->adcode;
        collect($nodes->children)->each(function ($node) use ($pinyin, $countryCode) {
            $this->insert(
                $node->adcode,
                $node->name,
                $pinyin->permalink($node->name, ''),
                $node->level,
                $countryCode,
                $node->center[0],
                $node->center[1]
            );
            if (!empty($node->children)) {
                collect($node->children)->each(function ($children) use ($pinyin, $node) {
                    if (isset($children->cityCode)) {
                        $this->insert(
                            $children->adcode,
                            $children->name,
                            $pinyin->permalink($children->name, ''),
                            $children->level,
                            $children->cityCode,
                            $children->center[0],
                            $children->center[1]
                        );
                        $this->spciCity($children->cityCode, $node->name, $pinyin->permalink($node->name, ''), $node->adcode, $node->center[0],  $node->center[1]);
                    } else {
                        $this->insert(
                            $children->adcode,
                            $children->name,
                            $pinyin->permalink($children->name, ''),
                            $children->level,
                            $children->provCode,
                            $children->center[0],
                            $children->center[1]
                        );
                    }
                    if (! empty($children->children)) {
                        collect($children->children)->each(function ($dis) use ($pinyin) {
                            $this->insert(
                                $dis->adcode,
                                $dis->name,
                                $pinyin->permalink($dis->name, ''),
                                $dis->level,
                                $dis->cityCode,
                                $dis->center[0],
                                $dis->center[1]
                            );
                        });
                    }
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

    private function spciCity($adcode, $name, $pinyin, $parentCode, $longitude, $latitude)
    {
        $bool = DB::table('districts')
            ->where('adcode', $adcode)
            ->first();
        if (! $bool) {
            DB::table('districts')
                ->insert([
                'adcode' => $adcode,
                'name' => $name,
                'pinyin' => $pinyin,
                'level' => 'city',
                'parent_code' => $parentCode,
                'center_longitude' => $longitude,
                'center_latitude' => $latitude,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
