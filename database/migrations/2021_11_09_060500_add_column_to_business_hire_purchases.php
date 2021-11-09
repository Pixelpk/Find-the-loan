<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBusinessHirePurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_hire_purchases', function (Blueprint $table) {
            $table->string('serial_number')->nullable();
            $table->string('register_number')->nullable();
            $table->string('purchase_used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_hire_purchases', function (Blueprint $table) {
            $table->dropColumn('serial_number');
            $table->dropColumn('register_number');
            $table->dropColumn('purchase_used');
        });
    }
}
