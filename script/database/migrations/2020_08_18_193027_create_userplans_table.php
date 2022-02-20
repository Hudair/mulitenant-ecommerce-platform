<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userplans', function (Blueprint $table) {
            $table->id();

            $table->string('order_no')->nullable();
            $table->double('amount')->nullable();
            $table->double('tax')->nullable();
            $table->string('trx')->nullable();
            $table->date('will_expire')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('category_id')->nullable();

           
            $table->integer('status')->default(2);
            $table->integer('payment_status')->default(2);
            

            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade'); 

            $table->foreign('plan_id')
            ->references('id')->on('plans'); 
           
            

            $table->foreign('category_id')
            ->references('id')->on('categories'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userplans');
    }
}
