<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chip_prices', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->integer("GB");
            $table->boolean("allow_voice");
            $table->decimal("price", 12 ,2);
            $table->boolean('allow_antenna')->default(0);
            
            $table->unsignedBigInteger("operator_id");
            $table->foreign("operator_id")
                ->references("id")
                ->on("operators")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('chip_prices');
    }
};
