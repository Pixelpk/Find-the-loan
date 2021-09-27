<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLoanPersonShareHolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_person_share_holders', function (Blueprint $table) {
            $table->string('passport')->nullable();
            $table->string('not_proof')->nullable();
            $table->integer('share_holder_detail_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_person_share_holders', function (Blueprint $table) {
            $table->dropColumn('passport');
            $table->dropColumn('not_proof');
            $table->dropColumn('share_holder_detail_id');
        });
    }
}
