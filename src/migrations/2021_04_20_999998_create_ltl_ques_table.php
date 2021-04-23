<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtlQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fmt_ltl_ques', function (Blueprint $table) {
            $table->id();
            $table->string('letter')->nullable();
            $table->foreignId('letter_image_media_id')->nullable();
            $table->foreignId('letter_audio_media_id')->nullable();
            $table->string('letter_trans')->nullable();
            $table->string('word')->nullable();
            $table->foreignId('word_image_media_id')->nullable();
            $table->foreignId('word_audio_media_id')->nullable();
            $table->string('word_trans')->nullable();
            $table->string('meaning')->nullable();
            $table->longText('info')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->foreignId('difficulty_level_id')->nullable()->comment = 'id from difficulty_levels table';
            $table->string('format_title')->nullable();
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
        Schema::dropIfExists('fmt_ltl_ques');
    }
}
