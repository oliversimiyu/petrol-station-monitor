<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fuel_tanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fuel_type');
            $table->decimal('capacity', 10, 2);
            $table->decimal('current_level', 10, 2);
            $table->decimal('minimum_level', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_tanks');
    }
};
