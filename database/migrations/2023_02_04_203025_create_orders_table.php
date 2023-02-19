<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal("value",8,2);
            $table->string("status");
            $table->date("dueDate");
            $table->string("reference");
            $table->string("type");
            $table->string("description")->nullable();
            $table->date("activationDate")->nullable();
            $table->date("cancellationDate")->nullable();
            $table->text("obs")->nullable();

            $table->unsignedBigInteger("plan_id");
            $table->foreign("plan_id")
                ->references("id")
                ->on("plans")
                ->onDelete("cascade");

            $table->unsignedBigInteger("client_id");
            $table->foreign("client_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

            $table->unsignedBigInteger("shipping_id")->nullable();
            $table->foreign("shipping_id")
                ->references("id")
                ->on("shippings")
                ->onDelete("cascade");


            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
