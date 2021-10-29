<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessHirePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hire_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->integer('hire_purchase_type');
            $table->string('agreement')->nullable();
            $table->string('type')->nullable();
            $table->string('distributer')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('number_of_units')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('price_per_unit')->nullable();
            $table->longText('remark')->nullable();
            $table->string('brochure')->nullable();
            $table->string('preferred_tenure_year')->nullable();
            $table->string('preferred_tenure_month')->nullable();
            $table->string('as_long_as_possiable')->nullable();
            $table->string('address')->nullable();
            $table->string('unit')->nullable();
            $table->string('building_name')->nullable();
            $table->string('property_type')->nullable();
            $table->string('lender_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('gearup_or_refinancing')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('deposit_paid')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('item_name_1')->nullable();
            $table->string('item_value1')->nullable();
            $table->string('item_name_2')->nullable();
            $table->string('item_value2')->nullable();
            $table->string('item_name_3')->nullable();
            $table->string('item_value3')->nullable();
            $table->string('lta_vehicle_information')->nullable();
            $table->string('company_name')->nullable();
            $table->string('sale_mane')->nullable();
          
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
        Schema::dropIfExists('business_hire_purchases');
    }
}
