<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverDraftPropertyLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_draft_property_lands', function (Blueprint $table) {
            $table->id();
            $table->integer('apply_loan_id');
            $table->string('address');
            $table->string('unit')->nullable();
            $table->string('building_name')->nullable();
            $table->string('lease_remaining_year')->nullable();
            $table->string('free_hold')->nullable()->default(0);
            $table->string('floor_area')->nullable();
            $table->string('useable_area')->nullable();
            $table->string('square_feet')->nullable()->default(0);
            $table->string('square_meter')->nullable()->default(0);
            $table->string('completed')->nullable()->default(0);
            $table->string('construction_year')->nullable();
            $table->string('construction_year_time')->nullable();
          
            $table->string('fix_rate')->nullable()->default(0);;
            $table->string('float_rate')->nullable()->default(0);;
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
        Schema::dropIfExists('over_draft_property_lands');
    }
}
