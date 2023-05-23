<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from')->unsigned();
            $table->bigInteger('to')->unsigned();
            $table->double('amount')->nullable(false);
            $table->date('date')->nullable(false);
            $table->time('time')->nullable(false);
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {

            $table->foreign('from')->references('id')->on('accounts');
            $table->foreign('to')->references('id')->on('accounts');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
