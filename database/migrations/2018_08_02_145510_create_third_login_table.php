<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_login', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sina_id');
            $table->integer('qq_id');
            $table->string('sina_avatar', 100)->default("");
            $table->string('qq_avatar', 100)->default("");
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
        Schema::dropIfExists('third_login');
    }
}
