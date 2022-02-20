<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(1);
            $table->unsignedBigInteger('variation_id')->default(1);
            $table->unsignedBigInteger('term_id');

            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');

            $table->foreign('variation_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');

           

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
        Schema::dropIfExists('attributes');
    }
}
