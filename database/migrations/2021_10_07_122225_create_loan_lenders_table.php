<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanLendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_lenders', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->integer('cbs_member')->default(0);
            $table->string('cbs_member_image')->nullable();
            $table->integer('financial_institute')->default(0);
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
        Schema::dropIfExists('loan_lenders');
    }
}
