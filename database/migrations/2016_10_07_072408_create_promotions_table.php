<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('company_logo');
            $table->string('offer_name');
            $table->text('offer_description')->nullable();
            $table->string('discount');
            $table->integer('type_id')->unsigned();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('promotion_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promotions');
    }
}
