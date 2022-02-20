<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('email');
            $table->string('password',255);
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('created_by')
            ->references('id')->on('users')
            ->onDelete('cascade');     

            $table->foreign('domain_id')
            ->references('id')->on('domains')
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
        Schema::dropIfExists('customers');
    }
}
