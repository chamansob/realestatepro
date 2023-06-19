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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name')->nullable();
            $table->string('plan_icon')->nullable();
            $table->string('plan_heading')->nullable();
            $table->string('plan_subheading')->nullable();
            $table->string('plan_pack_id')->nullable();
            $table->integer('plan_amount')->nullable();
            $table->integer('plan_credit')->default(1);
            $table->integer('plan_color');
            $table->boolean('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
