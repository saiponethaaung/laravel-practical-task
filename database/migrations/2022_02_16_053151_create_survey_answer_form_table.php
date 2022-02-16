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
        Schema::create('survey_answer_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_answer_id');
            $table->unsignedBigInteger('survey_form_id');
            $table->text('answer')->nullable();
            $table->timestamps();

            $table->foreign('survey_answer_id')->references('id')->on('survey_answer')->onDelete('cascade');
            $table->foreign('survey_form_id')->references('id')->on('survey_form')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_answer_form');
    }
};
