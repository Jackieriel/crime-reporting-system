<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('agency_name');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('about')->nullable();


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
        Schema::dropIfExists('agencies');
    }
}
