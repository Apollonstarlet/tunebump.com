<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->unsigned();
            $table->string('title', 255)->nullable()->default(null);
            $table->string('artist')->nullable()->default(null);
            $table->integer('genre')->unsigned();
            $table->string('genres', 255)->nullable()->default(null);
            $table->string('link')->nullable()->default(null);
            $table->string('spotify')->nullable()->default(null);
            $table->string('img')->nullable()->default(null);
            $table->integer('term')->unsigned();
            $table->integer('review')->unsigned()->default(0);
            $table->integer('like')->unsigned()->default(0);
            $table->integer('hot')->unsigned()->default(0);
            $table->enum('status', array('Active', 'Completed', 'Canceled'));
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
        Schema::dropIfExists('musics');
    }
}
