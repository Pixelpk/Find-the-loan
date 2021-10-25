<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverDraftInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_draft_insurances', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->string('insurance');
            $table->integer('type_of_policy')->nullable();
            $table->date('policy_start_date')->nullable();
            $table->string('name_of_policy_owner')->nullable();
            $table->string('insurer')->nullable();
            $table->integer('above')->nullable()->default(0);
            $table->string('surrender_value')->nullable();
            $table->string('name_of_insurance_company')->nullable();
            // $table->string('illustration')->nullable()->default(0);
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
        Schema::dropIfExists('over_draft_insurances');
    }
}
