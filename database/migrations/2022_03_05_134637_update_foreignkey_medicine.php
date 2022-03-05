<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignkeyMedicine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ============== Code untuk nambah & foreign column id dari table lain ========
        // Schema::table('products', function (Blueprint $table) {
        //     $table->unsignedBigInteger('category_id');
         
        //     $table->foreign('category_id')->references('id')->on('categories');
        // });
        // Schema::table('medicines', function (Blueprint $table) {
        //     $table->unsignedBigInteger('category_id');
            
        //     $table->foreign('category_id')->references('id')->on('categories');
        // });
        // ============================================================================

        Schema::table('medicines', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // ============== Code untuk nambah & foreign column id dari table lain ========
        // Schema::table('products', function (Blueprint $table) {
        //     $table->dropForeign(['category_id']);
        //     $table->dropColumn('category_id');
         
        //  });
        // Schema::table('medicines', function (Blueprint $table) {
        //     $table->dropForeign(['category_id']);
        //     $table->dropColumn('category_id');
         
        //  });
        // =============================================================================

        Schema::table('medicines', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
    }
}
