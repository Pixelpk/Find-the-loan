<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnFromMoreDocMsgDescTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('more_doc_msg_desc', function (Blueprint $table) {
            $table->dropColumn('document_of');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('more_doc_msg_desc', function (Blueprint $table) {
            //
        });
    }
}
