<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFinancePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_partners', function (Blueprint $table) {
            $table->string('property_types')->comment('1=Commercial Vehicle – Cars, lorries, trucks etc, 2=Industry Vehicle – 
            Cranes, forklift, Tractors etc, 3=Other Commercial & Industrial Equipment');
            $table->string('equipment_types')->comment('1=Office Equipment, 2=Other Commercial & Industrial Equipment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finance_partners', function (Blueprint $table) {
            $table->dropColumn('property_types');
            $table->dropColumn('equipment_types');
         
        });
    }
}
