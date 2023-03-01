<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('chips', function (Blueprint $table) {
            $table->id();

            $table->string("number_registration");
            $table->tinyInteger("type"); // M2M,4G

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chips');
    }
};
