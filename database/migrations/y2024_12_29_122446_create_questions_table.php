<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // Automatically creates an unsignedBigInteger primary key
            $table->unsignedBigInteger('quiz_id'); // Foreign key
            $table->string('question_text');
            $table->timestamps();
        
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
