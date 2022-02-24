<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('generic_name', 300);
            $table->string('form', 300);
            $table->string('restriction_formula', 300);
            $table->string('description', 300);
            $table->tinyInteger('faskes_tk1');
            $table->tinyInteger('faskes_tk2');
            $table->tinyInteger('faskes_tk3');
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
        Schema::dropIfExists('medicines');
    }
}
