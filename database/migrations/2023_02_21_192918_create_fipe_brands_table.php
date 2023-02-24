<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fipe_brands', function (Blueprint $table) {
            $table->id();

            $table->string("Label")->nullable();
            $table->string("Value")->nullable();
            $table->tinyInteger("vehicleType");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('fipe_brands');
    }
};
