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
        Schema::create('document_approvals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('uuid')->nullable();
            $table->integer('ordering')->nullable();
            $table->boolean('hidden')->nullable();

            $table->bigInteger('approval_config_id')->nullable();
            $table->bigInteger('approval_timestamp')->nullable();
            $table->bigInteger('approval_needed_user_id')->nullable();
            $table->bigInteger('approval_actual_signed_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_approvals');
    }
};
