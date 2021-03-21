<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayedFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displayed_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feedback_id')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();

            $table->foreign('feedback_id')->references('id')->on('feedbacks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('displayed_feedbacks');
    }
}
