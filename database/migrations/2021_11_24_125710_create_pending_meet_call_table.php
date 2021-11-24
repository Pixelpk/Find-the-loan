<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingMeetCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_meet_call', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id');
            $table->integer('partner_user_id');
            $table->integer('apply_loan_id');
            $table->dateTime('meet_call_date')->nullable();
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
        Schema::dropIfExists('pending_meet_call');
    }
}
