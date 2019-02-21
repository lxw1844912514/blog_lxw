<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeshiTable extends Migration
{
    /**
     * Run the migrations.
     *执行这个文件时执行这个文件
     * @return void
     */
    public function up()
    {
        Schema::create('ceshi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->default('this is test');
            $table->text('content');
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('ceshi');
    }
}
