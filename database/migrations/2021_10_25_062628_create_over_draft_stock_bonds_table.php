<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverDraftStockBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_draft_stock_bonds', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->string('currency');
            $table->integer('type')->nullable();
            $table->integer('company_purchased')->nullable();
            $table->string('total_indicative_value');
            $table->string('indicative_bid_price');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('over_draft_stock_bonds');
    }
}
