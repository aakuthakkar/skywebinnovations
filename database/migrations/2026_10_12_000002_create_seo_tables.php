<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->string('target_url')->nullable();
            $table->enum('search_intent', ['informational', 'navigational', 'transactional', 'commercial'])->default('informational');
            $table->unsignedInteger('search_volume')->nullable();
            $table->unsignedInteger('difficulty')->nullable();
            $table->decimal('cpc', 10, 2)->nullable();
            $table->unsignedInteger('current_position')->nullable();
            $table->unsignedInteger('target_position')->nullable();
            $table->unsignedInteger('previous_position')->nullable();
            $table->date('first_tracked_at')->nullable();
            $table->date('last_checked_at')->nullable();
            $table->enum('tracking_frequency', ['daily', 'weekly', 'monthly'])->default('weekly');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('keyword');
            $table->index('is_active');
            $table->index('last_checked_at');
        });

        Schema::create('seo_keyword_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seo_keyword_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('position')->nullable();
            $table->string('search_engine')->default('google');
            $table->string('url')->nullable();
            $table->unsignedInteger('search_volume_snapshot')->nullable();
            $table->date('checked_at');
            $table->timestamps();

            $table->index(['seo_keyword_id', 'checked_at']);
        });

        Schema::create('seo_backlinks', function (Blueprint $table) {
            $table->id();
            $table->string('source_url');
            $table->string('source_domain');
            $table->string('target_url');
            $table->string('anchor_text')->nullable();
            $table->enum('link_type', ['dofollow', 'nofollow', 'sponsored', 'ugc'])->default('dofollow');
            $table->unsignedTinyInteger('domain_authority')->nullable();
            $table->unsignedTinyInteger('page_authority')->nullable();
            $table->date('first_seen_at');
            $table->date('last_seen_at');
            $table->date('lost_at')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('source_domain');
            $table->index('target_url');
            $table->index('is_active');
        });

        Schema::create('seo_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('source_path');
            $table->string('target_path');
            $table->enum('type', ['301', '302', '307'])->default('301');
            $table->string('source_host')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('hit_count')->default(0);
            $table->timestamps();

            $table->unique(['source_path', 'source_host']);
            $table->index('is_active');
        });

        Schema::create('seo_audits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['running', 'completed', 'failed'])->default('completed');
            $table->unsignedTinyInteger('score')->nullable();
            $table->json('results')->nullable();
            $table->json('issues')->nullable();
            $table->text('summary')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('completed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_keyword_rankings');
        Schema::dropIfExists('seo_keywords');
        Schema::dropIfExists('seo_backlinks');
        Schema::dropIfExists('seo_redirects');
        Schema::dropIfExists('seo_audits');
    }
};
