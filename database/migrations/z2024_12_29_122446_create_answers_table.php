<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('question_id'); // Foreign key
            $table->string('answer_text');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
