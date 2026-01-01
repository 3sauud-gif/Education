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
Schema::create('qodrat_quizzes', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('course_id');
    $table->string('question');
    $table->string('option_a');
    $table->string('option_b');
    $table->string('option_c');
    $table->string('option_d');
    $table->string('correct_answer');
    $table->timestamps();

    $table->foreign('course_id')
          ->references('id')
          ->on('qodrat_courses')
          ->onDelete('cascade');
});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qodrat_quizzes');
    }
};
