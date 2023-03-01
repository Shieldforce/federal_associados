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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("addressable_id");
            $table->string("addressable_type");
            $table->string("cep")->nullable();
            $table->string("address")->nullable();
            $table->string("number")->nullable();
            $table->string("district")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->text('refer_point')->nullable();
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
        Schema::dropIfExists('address');
    }
};
