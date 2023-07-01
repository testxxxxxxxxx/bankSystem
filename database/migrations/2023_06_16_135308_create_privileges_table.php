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
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('controller_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('privileges', function (Blueprint $table) {

            $table->foreign('controller_id')->references('id')->on('controllers');
            $table->foreign('group_id')->references('id')->on('groups');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privileges');
    }
};
