<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0);
            $table->string('name')->comment('栏目名称');
            $table->string('route')->comment('路由');
            $table->text('desc')->nullable();
            $table->tinyInteger('sort')->default(1);
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('categorys', function (Blueprint $table) {
            //
            Schema::dropIfExists('categorys');
//        });
    }
}
