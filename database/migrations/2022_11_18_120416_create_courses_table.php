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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('tutor_name');
            $table->integer('price')->default(0);
            $table->string('age');
            $table->string('introduction_video_link');
            $table->string('description');
            $table->string('cource_title');
            $table->string('image');
            $table->string('end_of_my_course');
            $table->string('should_take');
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
        Schema::dropIfExists('courses');
    }
};
