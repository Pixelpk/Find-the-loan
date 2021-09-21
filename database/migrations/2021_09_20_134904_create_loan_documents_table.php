<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apply_loan_id');
            $table->string('statement');
            $table->string('latest_year')->nullable();
            $table->string('year_before');
            $table->string('current_year')->nullable();
            $table->string('optional_documents')->nullable();
            $table->string('reveivable_payable_listing')->nullable();
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
        Schema::dropIfExists('loan_documents');
    }
}
