<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShareHolderConstitutionFileColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_person_share_holders', function (Blueprint $table) {
            $table->string('constitution')->nullable()->after('apply_loan_id');
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
            $table->dropColumn('constitution');
        });
    }
}
