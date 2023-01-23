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
        Schema::create('weekly_updates', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->longText('done');
            $table->longText('priorities');
            $table->longText('concerns');
            $table->longText('summary');
            $table->date('date');
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
        Schema::dropIfExists('weekly_updates');
    }
};
