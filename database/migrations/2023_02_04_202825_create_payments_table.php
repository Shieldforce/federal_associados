<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string("type");
            $table->decimal("value", 12 ,2);
            $table->date("date");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
