<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlaliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urlalias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('controller');
            $table->string('method')->default('show');
            $table->text('arguments')->nullable();
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urlalias');
    }
}
