<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('billets', function (Blueprint $table) {
            $table->id();

            $table->string("our_number");
            $table->text("link");
            $table->text("bar_code");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('billets');
    }
};
