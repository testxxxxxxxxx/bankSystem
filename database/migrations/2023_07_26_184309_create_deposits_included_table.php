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
            $table->bigInteger('account_id')->unsigned();
            $table->timestamp('start')->nullable(false);
            $table->timestamp('stop')->nullable(false);
            $table->timestamps();
        });

        Schema::table('deposits_included', function (Blueprint $table) {

            $table->foreign('interest_id')->references('id')->on('interests');
            $table->foreign('account_id')->references('id')->on('accounts');

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
