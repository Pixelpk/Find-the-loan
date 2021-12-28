<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColumnNullableToFinancePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_partners', function (Blueprint $table) {
            $table->string('property_types')->nullable()->comment('3=Commercial Vehicle – Cars, lorries, trucks etc, 4=Industry Vehicle – Cranes, forklift, Tractors etc, 5=Other Commercial & Industrial Equipment')->change();
            $table->string('equipment_types')->nullable()->comment('1=Office Equipment, 2=Other Commercial & Industrial Equipment')->change();
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

        });
    }
}
