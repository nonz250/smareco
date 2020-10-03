<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('provider_id');
            $table->string('contract_id');
            $table->integer('product_id');
            $table->integer('category_id');
            $table->string('code');
            $table->string('name');
            $table->string('kana');
            $table->integer('tax_division');
            $table->integer('price');
            $table->integer('customer_price');
            $table->integer('cost');
            $table->text('description');
            $table->timestamps();

            $table->unique([
                'provider_id',
                'contract_id',
                'product_id',
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
        Schema::dropIfExists('products');
    }
}
