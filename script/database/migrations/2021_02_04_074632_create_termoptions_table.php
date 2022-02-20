<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termoptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('term_id');
            $table->string('name');
            $table->integer('type')->default(0); //0 = parent 1= child 
            $table->double('amount')->nullable();
            $table->integer('amount_type')->default(1);// 0 = percent, 1= fixed
            $table->integer('is_required')->default(0);
            $table->integer('select_type')->default(0);
            $table->unsignedBigInteger('p_id')->nullable();
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('termoptions');
    }
}
