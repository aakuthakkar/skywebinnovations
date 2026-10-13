<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('is_published');
            $table->index('slug');
            $table->index('published_at');
            $table->index('category');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
