<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('antenas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("itemable_id");
            $table->foreign("itemable_id")
                ->references("id")
                ->on("items")
                ->onDelete("cascade");

            $table->string("number_registration");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('antenas');
    }
};
