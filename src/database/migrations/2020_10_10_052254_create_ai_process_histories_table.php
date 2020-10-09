<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiProcessHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_process_histories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('contract_id')->index();
            $table->integer('status');
            $table->dateTime('notification_datetime');
            $table->timestamps();

            $table->unique('contract_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ai_process_histories');
    }
}
