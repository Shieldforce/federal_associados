<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("billet_id");
            $table->foreign("billet_id")
                ->references("id")
                ->on("billets")
                ->onDelete("cascade");

            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")
                ->references("id")
                ->on("orders")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
