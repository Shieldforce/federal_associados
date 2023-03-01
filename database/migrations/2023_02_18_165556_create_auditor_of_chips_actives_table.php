<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditor_of_chips_actives', function (Blueprint $table) {
            $table->id();

            $table->string("order_id")->nullable();
            $table->string("amount_billings")->nullable();
            $table->string("user_name")->nullable();
            $table->string("chip_number")->nullable();
            $table->string("line_number")->nullable();

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
        Schema::dropIfExists('auditor_of_chips_actives');
    }
};
