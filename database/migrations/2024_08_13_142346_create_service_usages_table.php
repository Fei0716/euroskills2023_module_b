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
        Schema::create('service_usages', function (Blueprint $table) {
            $table->id();
            $table->double('usage_duration');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('api_token_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('api_token_id')->references('id')->on('api_tokens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_usages');
    }
};
