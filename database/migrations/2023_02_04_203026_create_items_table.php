<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string("itemable_type");
            $table->integer("itemable_id");

            $table->string("type")->nullable();
            $table->date("cancel_date")->nullable();
            $table->string("status")->nullable();

            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")
                ->references("id")
                ->on("orders")
                ->onDelete("cascade");

            $table->unsignedBigInteger("reference_price_id")->nullable();

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
