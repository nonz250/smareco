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
            $table->string('id')->primary();
            $table->string('provider_id');
            $table->string('contract_id');
            $table->string('customer_id');
            $table->string('customer_code');
            $table->string('store_id');
            $table->string('rank');
            $table->string('name');
            $table->string('kana');
            $table->string('email');
            $table->string('sex');
            $table->integer('mail_receive_flag');
            $table->integer('status');
            $table->timestamps();

            $table->unique([
                'provider_id',
                'contract_id',
                'customer_id',
            ]);
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
