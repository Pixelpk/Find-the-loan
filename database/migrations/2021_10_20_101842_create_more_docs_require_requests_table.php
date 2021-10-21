<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoreDocsRequireRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_docs_require_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->integer('partner_id');
            $table->integer('user_id')->comment('user id of finance partner user who request for more docs');
            $table->string('quote_additional_doc_idz')->nullable();
            $table->text('msg_desc_section')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('more_docs_require_requests');
    }
}
