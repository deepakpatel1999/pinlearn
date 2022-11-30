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
        Schema::create('course_lectures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            // $table->unsignedBigInteger('section_id');
            // $table->foreign('section_id')->references('id')->on('course_sections')->onDelete('cascade');
            $table->integer('course_section_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('ordering')->nullable();
            $table->string('video')->nullable();
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
        Schema::dropIfExists('course_lectures');
    }
};
