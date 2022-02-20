<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('term_id');
            $table->double('price');
            $table->double('regular_price');
            $table->double('special_price')->nullable();
            $table->integer('price_type')->default(1);
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->foreign('term_id')
            ->references('id')->on('terms')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
