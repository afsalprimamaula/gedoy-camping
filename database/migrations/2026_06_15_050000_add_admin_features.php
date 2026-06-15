<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add icon and is_active columns to camping_packages
        Schema::table('camping_packages', function (Blueprint $table) {
            if (!Schema::hasColumn('camping_packages', 'icon')) {
                $table->string('icon')->default('⛺')->after('features');
            }
            if (!Schema::hasColumn('camping_packages', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('icon');
            }
        });

        // Create gallery_images table
        if (!Schema::hasTable('gallery_images')) {
            Schema::create('gallery_images', function (Blueprint $table) {
                $table->id();
                $table->string('path');               // Storage path e.g. gallery/xxx.jpg
                $table->string('original_name')->nullable();
                $table->unsignedBigInteger('size')->nullable(); // bytes
                $table->string('mime_type')->nullable();
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::table('camping_packages', function (Blueprint $table) {
            $table->dropColumn(['icon', 'is_active']);
        });
        Schema::dropIfExists('gallery_images');
    }
};
