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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    
        // Insert 100 random colors
        $colors = array();
        for ($i = 0; $i < 100; $i++) {
            $name = 'Color ' . ($i+1);
            $color = '#' . substr(md5(mt_rand()), 0, 6);
            $created_at = now();
            $updated_at = now();
            $colors[] = "('$name', '$color', 1, '$created_at', '$updated_at')";
        }
        $colors_values = implode(',', $colors);
        DB::insert("INSERT INTO `colors` (`name`, `color`, `status`, `created_at`, `updated_at`) VALUES $colors_values");
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
