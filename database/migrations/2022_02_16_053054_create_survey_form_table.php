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
        Schema::create('survey_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->string('name')->nullable();
            $table->string('values')->nullable();
            $table->enum('type', ['text', 'string', 'datepicker', 'checkbox', 'radio', 'dropdown', 'file', 'range']);
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->bigInteger('max_size')->default(-1);
            $table->bigInteger('char_count')->default(-1);
            $table->text('options')->nullable();
            $table->boolean('optional')->default(false);
            $table->boolean('multiple')->default(false);
            $table->timestamps();

            $table->index('survey_id');

            $table->foreign('survey_id')->references('id')->on('survey')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_form');
    }
};
