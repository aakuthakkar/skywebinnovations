<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->string('location')->default('header'); // header or footer
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('target_blank')->default(false);
            $table->timestamps();

            $table->index('location');
            $table->index('order');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
    }
};
