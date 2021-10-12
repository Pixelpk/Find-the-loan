<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUserLoanReject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loan_reject', function (Blueprint $table) {
            $table->integer('customer_reject_reason_id');
            $table->integer('internal_reject_reason_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loan_reject', function (Blueprint $table) {
            //
        });
    }
}
