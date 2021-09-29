<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnToApplyLoan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_loans', function (Blueprint $table) {
            $table->string('enquiry_id')->nullable();
            $table->dateTime('applied_at')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apply_loans', function (Blueprint $table) {
            $table->dropColumn('enquiry_id');
            $table->dropColumn('applied_at');
            $table->dropColumn('status');
        });
    }
}
