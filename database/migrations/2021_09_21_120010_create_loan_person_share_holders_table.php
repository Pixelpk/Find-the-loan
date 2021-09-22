<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPersonShareHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_person_share_holders', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->string('nric_front');
            $table->string('nric_back');
            $table->string('nao_latest');
            $table->string('nao_older');
            $table->string('cbs');
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
        Schema::dropIfExists('loan_person_share_holders');
    }
}
