<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_company_details', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->integer('share_holder')->default(0)->nullable();
            $table->string('company_start_date');
            $table->integer('number_of_share_holder');
            $table->integer('sector_id');
            $table->integer('revenue');
            $table->integer('percentage_shareholder');
            $table->integer('company_structure_type_id');
            $table->integer('number_of_employees');
            $table->integer('profitable_latest_year')->comment('yes,no');
            $table->integer('profitable_before_year')->comment('yes,no');
            $table->integer('optional_revenuee')->nullable();
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
        Schema::dropIfExists('loan_company_details');
    }
}
