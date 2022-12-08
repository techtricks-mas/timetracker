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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->string('name');
            $table->string('company');
            $table->string('interviewer');
            $table->string('role');
            $table->dateTime('time');
            $table->string('job');
            $table->string('url');
            $table->string('status')->default('scheduled');
            $table->string('reply')->nullable();
            $table->string('reason')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('interviews');
    }
};
