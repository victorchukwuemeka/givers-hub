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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('view')->nullable();
            $table->text('content')->nullable();
            $table->string('url')->nullable();
            $table->text('iframe')->nullable();
            $table->string('linked_view')->nullable();
            $table->string('linked_post')->nullable();
            $table->text('external_link')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
