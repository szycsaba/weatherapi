<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time');
            $table->string('name');
            $table->decimal('lat', 10, 4);
            $table->decimal('lon', 10, 4);
            $table->decimal('temperature', 6, 2);
            $table->decimal('temp_min', 6, 2);
            $table->decimal('temp_max', 6, 2);
            $table->integer('pressure');
            $table->integer('humidity');
            $table->timestamps();

            $table->index(['name', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
