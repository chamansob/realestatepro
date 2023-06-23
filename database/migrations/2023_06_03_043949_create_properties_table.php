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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('ptype_id');
            $table->string('amenities_id');
            $table->string('property_name');
            $table->string('property_slug');            
            $table->string('property_code');
            $table->enum('property_status',['rent', 'sale'])->default('sale');
            $table->string('lowest_price')->nullable();
            $table->string('max_price')->nullable();
            $table->string('property_thumbnail');
            $table->text('short_descp')->nullable();
            $table->text('long_descp')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('garage')->nullable();
            $table->string('garage_size')->nullable();
            $table->integer('property_size')->nullable();
            $table->string('property_video')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id');
            $table->integer('state_id');
            $table->string('postal_code')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('featured')->default(0);
            $table->integer('hot')->default(0);
            $table->integer('agent_id')->nullable();
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
        Schema::dropIfExists('properties');
    }
};
