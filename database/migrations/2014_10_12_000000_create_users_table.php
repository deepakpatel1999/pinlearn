<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->tinyInteger('type')->default(0);
            /* Users: 0=>User, 1=>Admin, 2=>Manager */
            $table->string('user_name');
            $table->string('timezone')->nullable();
            $table->string('email')->unique();
            $table->string('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('Zoom_activation')->nullable();
            $table->string('Phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('Zipcode')->nullable();
            $table->string('language')->nullable();
            $table->string('video_id')->nullable();
            $table->string('commition_rate')->nullable();
            $table->string('biography')->nullable();
            $table->Integer('status')->nullable();
            $table->Integer('phone_verified_at')->nullable();
            $table->Integer('in_hone_page')->nullable();
            $table->Integer('featured')->nullable();

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
        // // Schema::table('users', function($table) {
        // //     $table->dropColumn('paid');
        // });
    }
};
