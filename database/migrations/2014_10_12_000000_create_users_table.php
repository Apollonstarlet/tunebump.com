<?php
   
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
   
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 30)->nullable()->default(null);
            $table->string('lastname', 30)->nullable()->default(null);
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('password');
            $table->enum('role', array('artist', 'admin', 'curator'));
            $table->string('spotifyId', 30)->nullable()->default(null);
            $table->string('img')->default('images/user/default.jpg');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}