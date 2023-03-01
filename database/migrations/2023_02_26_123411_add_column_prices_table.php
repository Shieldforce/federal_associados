<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("adhesion_percentage")->nullable()->after("cancellationDate");
            $table->decimal("adhesion_price", 12, 2)->nullable()->after("adhesion_percentage");
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
