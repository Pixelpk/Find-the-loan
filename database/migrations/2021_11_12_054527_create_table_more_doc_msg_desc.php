<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMoreDocMsgDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_doc_msg_desc', function (Blueprint $table) {
            $table->id();
            $table->integer('more_doc_request_id');
            $table->tinyInteger('if_any')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->integer('within_days')->nullable();
            $table->integer('past_months')->nullable();
            $table->integer('valid_for')->nullable();
            $table->string('more_doc_reasons');
            $table->string('document_of');
            $table->string('quote_additional_doc_id');
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
        Schema::dropIfExists('table_more_doc_msg_desc');
    }
}
