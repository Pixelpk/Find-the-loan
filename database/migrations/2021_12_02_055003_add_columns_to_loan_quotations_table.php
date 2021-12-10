<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLoanQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_quotations', function (Blueprint $table) {
            $table->dateTime('proceeded_at')->nullable();
            $table->dateTime('offer_signed_at')->nullable();
            $table->dateTime('offer_disbursed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_quotations', function (Blueprint $table) {
            //
        });
    }
}
