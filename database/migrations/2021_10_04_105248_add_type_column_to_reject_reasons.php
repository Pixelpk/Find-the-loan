<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToRejectReasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reject_reasons', function (Blueprint $table) {
            $table->tinyInteger('type')->comment('1=Internal, 2=Shown to customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reject_reasons', function (Blueprint $table) {
            //
        });
    }
}
