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
        Schema::create('daily_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->dateTime('time');
            $table->string('vpn')->default('no');
            $table->string('work')->default('no');
            $table->string('ip')->nullable();
            $table->string('project')->nullable();
            $table->string('turl')->nullable();
            $table->text('tdescription')->nullable();
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->string('hours')->nullable();
            $table->string('running')->default('yes');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('daily_works');
    }
};
