<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable(); //payment getway id
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('user_id');
           
            $table->integer('order_type')->default(0);
            $table->integer('payment_status')->default(2);
            $table->string('status')->default(0);
            $table->double('tax')->default(0);
            $table->double('shipping')->default(0);
            $table->double('total')->default(0);
            
            $table->timestamps();

            $table->foreign('customer_id')
            ->references('id')->on('customers')
            ->onDelete('cascade'); 

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade'); 
            
            $table->foreign('category_id')
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
        Schema::dropIfExists('orders');
    }
}
