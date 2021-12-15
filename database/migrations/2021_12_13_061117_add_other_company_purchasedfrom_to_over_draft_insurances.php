<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherCompanyPurchasedfromToOverDraftInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('over_draft_insurances', function (Blueprint $table) {
            $table->string('other_purchased_from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('over_draft_insurances', function (Blueprint $table) {
            $table->dropColumn('other_purchased_from');
        });
    }
}
