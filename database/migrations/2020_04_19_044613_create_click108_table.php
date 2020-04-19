<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClick108Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click108s', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date')->comment('存放過去至今的日期');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('click108_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('click108_name' , 32)->comment('星座名稱');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('click108_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('click108_type' , 32)->comment('運勢分類');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('click108_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('click108_id')->comment('星座主表ID');
            $table->foreign('click108_id')->references('id')->on('click108s')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('click108_name_id')->comment('星座ID');
            $table->tinyInteger('type')->comment('分類ID');
            $table->string('star')->comment('星座評分資訊');
            $table->tinyInteger('star_count')->comment('星座評分分數');
            $table->string('info')->comment('星座說明資訊');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('click108s');
        Schema::dropIfExists('click108_names');
        Schema::dropIfExists('click108_infos');
        Schema::dropIfExists('click108_types');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
