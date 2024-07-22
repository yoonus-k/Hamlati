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
        Schema::create('Bookings', function (Blueprint $table) {
            $table->id();
            $table->string('national_id');
            $table->string('name');
            $table->string('gender');
            $table->string('age');
            $table->string('nationality');
            $table->string('group_id');
            $table->string('special_needs');
            $table->string('medical_conditions');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_bookings_');
    }
};
