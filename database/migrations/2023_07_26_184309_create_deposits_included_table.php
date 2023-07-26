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
        Schema::create('deposits_included', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('interest_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('start')->nullable(false);
            $table->date('stop')->nullable(false);
            $table->timestamps();
        });

        Schema::table('deposits_included', function (Blueprint $table) {

            $table->foreign('interest_id')->references('id')->on('interests');
            $table->foreign('user_id')->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits_included');
    }
};