<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCompanyDetailExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_company_details', function (Blueprint $table) {
            $table->integer('listed_company_check')->default(0);
            $table->string('country')->nullable();
            $table->string('subsidiary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_company_details', function (Blueprint $table) {
            $table->dropColumn('listed_company_check');
            $table->dropColumn('country');
            $table->dropColumn('subsidiary');
        });
    }
}
