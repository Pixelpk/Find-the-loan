<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoNewColumnsNoLoanReason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_quotations', function (Blueprint $table) {
            $table->string('no_loan_reason')->nullable();
            $table->string('no_loan_reason_ellaborate')->nullable();
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
            $table->dropColumn('no_loan_reason');
            $table->dropColumn('no_loan_reason_ellaborate');
        });
    }
}
