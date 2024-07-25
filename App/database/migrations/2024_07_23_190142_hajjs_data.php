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
        Schema::create('hajjs', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('pilgrim_id'); // Pilgrim_ID from CSV
            $table->string('national_id_iqama'); // National_ID/Iqama as string
            $table->string('first_name'); // Splitted from Name
            $table->string('last_name'); // Splitted from Name
            $table->char('gender', 1); // Gender (M/F)
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hajjs');
    }
};
