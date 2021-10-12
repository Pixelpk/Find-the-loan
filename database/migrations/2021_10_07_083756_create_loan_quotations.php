<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_quotations', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->integer('partner_id');
            $table->integer('quoted_by')->comment('user_id of financePartner user who put this quotation');
            $table->text('quantum_interest');
            $table->text('one_time_fee');
            $table->text('monthly_fee');
            $table->text('annual_fee');
            $table->text('legal_fee')->nullable();
            $table->text('if_insurance_required');
            $table->text('eir')->nullable();
            $table->text('repayment')->nullable()->comment("contains info about repayment terms, remarks(Seen by all internal users), Personal notepad (read only by me)");
            $table->tinyInteger('status')->nullable();
            $table->date('quote_validity');
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
        // Schema::dropIfExists('loan_quotations');
    }
}
