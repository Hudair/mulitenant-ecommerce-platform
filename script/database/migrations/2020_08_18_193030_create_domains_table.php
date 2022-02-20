<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->unsignedBigInteger('userplan_id');
            $table->string('full_domain');
            $table->integer('status')->default(1);
            $table->integer('type')->default(1);//1=subdomain 2= customdomain
            $table->date('will_expire')->nullable();
            $table->json('data')->nullable();
            $table->integer('is_trial')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('template_id')->default(1);
            $table->integer('shop_type')->default(1);
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');

            $table->foreign('template_id')
            ->references('id')->on('templates');

            $table->foreign('userplan_id')
            ->references('id')->on('userplans');

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
        Schema::dropIfExists('domains');
    }
}
