<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromMoreDocsRequireRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('more_docs_require_requests', function (Blueprint $table) {
            $table->dropColumn('quote_additional_doc_idz');
            $table->dropColumn('msg_desc_section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('more_docs_require_requests', function (Blueprint $table) {
            $table->string('quote_additional_doc_idz');
            $table->text('msg_desc_section');
        });
    }
}
