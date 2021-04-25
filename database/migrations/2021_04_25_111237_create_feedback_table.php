<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('on_incident');
            $table->unsignedBigInteger('from_user');
            $table->foreign('on_incident')
                ->references('id')->on('incidents')
                ->onDelete('cascade');
            $table->foreign('from_user')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->text('body');


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
        Schema::dropIfExists('feedback');
    }
}
