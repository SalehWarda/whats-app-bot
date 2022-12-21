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
        Schema::create('qeus', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('header')->nullable();
            $table->string('body')->nullable();
            $table->string('footer')->nullable();

            $table->integer('frist')->default(0);
            $table->integer('language')->nullable();//true ar % false en

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
        Schema::dropIfExists('qeus');
    }
};
