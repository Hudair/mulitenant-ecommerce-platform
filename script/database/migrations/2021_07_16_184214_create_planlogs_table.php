<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('userplan_id');
            $table->unsignedBigInteger('domain_id');

            $table->foreign('userplan_id')
            ->references('id')->on('userplans')
            ->onDelete('cascade'); 

            $table->foreign('domain_id')->references('id')->on('domains')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planlogs');
    }
}
