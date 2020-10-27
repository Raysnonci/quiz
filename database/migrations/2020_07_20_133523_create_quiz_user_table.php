<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_user', function (Blueprint $table) {
            $table->bigIncrements('quiz_user_id');
            $table->integer('quiz_user_quiz_id');
            $table->integer('quiz_user_user_id');
            $table->unsignedBigInteger('quiz_user_created_by')->nullable();
            $table->unsignedBigInteger('quiz_user_updated_by')->nullable();
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
        Schema::dropIfExists('quiz_user');
    }
}
