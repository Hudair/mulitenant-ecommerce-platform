<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdershippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordershippings', function (Blueprint $table) {
          
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('shipping_id');
            
            $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade'); 

            $table->foreign('location_id')
            ->references('id')->on('categories')
            ->onDelete('cascade'); 

            $table->foreign('shipping_id')
            ->references('id')->on('categories')
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
        Schema::dropIfExists('ordershippings');
    }
}
