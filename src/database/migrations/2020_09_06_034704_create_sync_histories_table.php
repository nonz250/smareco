<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyncHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_histories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('provider_id');
            $table->string('contract_id');
            $table->string('target');
            $table->dateTime('sync_datetime');
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
        Schema::dropIfExists('sync_histories');
    }
}
