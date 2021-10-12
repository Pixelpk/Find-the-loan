<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAdditionalDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_additional_docs', function (Blueprint $table) {
            $table->id();
            $table->integer('info_type')->comment("1=Company related, 2=ACRA related, 3=Project.Invoice/PO financing related, 4=DCP and Secured overdraft related,5=Machinery/equipment/vehicle related, 6=Individual related,7=Property related, 8=Equipment/Vehicle related");
            $table->string('info');
            $table->integer('doc_type')->comment('1=document file, 2=input');
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
        Schema::dropIfExists('quote_additional_docs');
    }
}
