<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverDraftTrustFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_draft_trust_funds', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->string('currency');
            $table->integer('bank');
            $table->string('total_indicative_value');
            $table->string('indicative_nav');
           
            $table->string('other_bank_name')->nullable();
            $table->string('fund_name')->nullable();
            $table->string('fd_sd_date')->nullable();
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
        Schema::dropIfExists('over_draft_trust_funds');
    }
}
