<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reporter_id');
            $table->foreign('reporter_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('crime_category_id');

            $table->string('lga');
            $table->string('address');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('video')->nullable();

            $table->enum('status',['pending verification','verified - investigation openned','verified - investigation closed'])->default('pending verification');

            $table->string('progress_remark')->default('waiting verification');

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
        Schema::dropIfExists('incidents');
    }
}
