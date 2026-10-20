<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_guide_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('page_key', 100);
            $table->timestamp('seen_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'page_key']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('guide_seen_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_guide_progress');

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('guide_seen_at')->nullable()->after('avatar');
        });
    }
};
