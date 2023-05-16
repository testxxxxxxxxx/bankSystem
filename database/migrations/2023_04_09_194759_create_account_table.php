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
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->double('balance');
            $table->bigInteger('typeOfAccount')->unsigned();
            $table->bigInteger('userId')->unsigned();
            $table->timestamps();
        });
        Schema::table('account',function(Blueprint $table){

            $table->foreign('typeOfAccount')->references('id')->on('types_of_account');
            $table->foreign('userId')->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account');
    }
};
