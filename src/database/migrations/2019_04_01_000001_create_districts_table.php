<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * https://webapi.amap.com/ui/1.0/ui/geo/DistrictExplorer/assets/d_v1/country_tree.json
 * @author chenghuiyong <chenghuiyong1987@gmail.com>
 */
class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adcode')->index()->comment('区划编码');
            $table->string('name')->comment('区划名称');
            $table->string('pinyin')->comment('区划名称拼音');
            $table->enum('level', ['country', 'province', 'city', 'district'])->comment('区划级别');
            $table->string('parent_code')->comment('上级区划编码');
            $table->string('center_longitude')->comment('区划中心经度');
            $table->string('center_latitude')->comment('区划中心纬度');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
