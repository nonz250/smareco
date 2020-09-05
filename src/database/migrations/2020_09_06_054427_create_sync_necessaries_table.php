<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyncNecessariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_necessaries', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('provider_id');
            $table->string('contract_id');
            $table->string('target');
            $table->text('field');
            $table->timestamps();

            $table->index(['provider_id', 'contract_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sync_necessaries');
    }
}
