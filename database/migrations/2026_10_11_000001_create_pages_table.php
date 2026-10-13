<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('page_template')->default('default');
            $table->boolean('is_published')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('is_published');
            $table->index('slug');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
