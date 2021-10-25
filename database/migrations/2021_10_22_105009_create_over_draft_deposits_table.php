<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverDraftDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_draft_deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->integer('deposit_type');
            $table->string('currency');
            $table->string('deposit_amount');
            $table->string('deposit_ac_number');
            $table->string('bank');
            $table->string('other_bank_name')->nullable();
            $table->string('tranche')->nullable();
            $table->string('fd_sd')->nullable();
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
        Schema::dropIfExists('over_draft_deposits');
    }
}
