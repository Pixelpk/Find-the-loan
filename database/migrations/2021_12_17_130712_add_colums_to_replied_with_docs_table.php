<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToRepliedWithDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('replied_with_docs', function (Blueprint $table) {
            $table->string('personal_loan_list')->nullable();
            $table->string('personal_assets_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('replied_with_docs', function (Blueprint $table) {
            //
        });
    }
}
