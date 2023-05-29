<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->unsigned();
            $table->string('title', 255)->nullable()->default(null);
            $table->string('spotifyId')->nullable()->default(null);
            $table->string('img')->default('images/music.png');
            $table->integer('genre')->unsigned();
            $table->string('genres', 255)->nullable()->default(null);
            $table->integer('tracks')->default(0);
            $table->integer('followers')->default(0);
            $table->enum('status', array('review', 'accept', 'denied'));
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
        Schema::dropIfExists('playlists');
    }
}
