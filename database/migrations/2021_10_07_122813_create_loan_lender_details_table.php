<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanLenderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_lender_details', function (Blueprint $table) {
            $table->id();
            $table->integer('loan_lender_id');
            $table->integer('apply_loan_id');
            $table->integer('lender_id');
            // $table->integer('lender_type');
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
        Schema::dropIfExists('loan_lender_details');
    }
}
