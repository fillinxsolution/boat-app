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
        Schema::create('portfolio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('title')->nullable();
            $table->string('yacht_name')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('captain_name')->nullable();
            $table->string('captain_email')->nullable();
            $table->enum('status',['Active','DeActive'])->default('Active');
            $table->foreign('subcategory_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio');
    }
};
