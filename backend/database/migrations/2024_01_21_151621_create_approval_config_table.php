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
        Schema::create('approval_configs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('uuid')->nullable();
            $table->integer('ordering')->nullable();
            $table->boolean('hidden')->nullable();

            $table->text('position')->nullable();
            $table->bigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_config');
    }
};
