<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('cost');
            $table->date('date');
        });

        Schema::create('stock', function (Blueprint $table) {
            $table->date('date');
            $table->string('name', 255);
            $table->unsignedInteger('total');
            $table->unsignedInteger('ordered');
            $table->decimal('avg_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplies');
        Schema::dropIfExists('stock');
    }
}
