<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->default('');
            $table->text('content');
            $table->timestamps();
        });
        Schema::create('user_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('notice_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
        Schema::dropIfExists('user_notice');
    }
}
