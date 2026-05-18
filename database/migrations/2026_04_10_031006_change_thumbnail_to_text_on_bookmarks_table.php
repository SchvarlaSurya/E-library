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
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->text('thumbnail')->nullable()->change();
            $table->text('title')->nullable()->change();
            $table->text('author')->nullable()->change();
            $table->string('book_id', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->string('thumbnail', 255)->nullable()->change();
            $table->string('title', 255)->nullable()->change();
            $table->string('author', 255)->nullable()->change();
            $table->string('book_id', 255)->change();
        });
    }
};
