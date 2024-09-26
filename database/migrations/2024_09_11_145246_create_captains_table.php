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
        Schema::create('captains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('banner_image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('director_name')->nullable();
            $table->string('address')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('sector')->nullable();
            $table->text('description')->nullable();
            $table->string('insurance')->nullable();
            $table->string('boat_registration_papers')->nullable();
            $table->enum('status',['Approved','Rejected','Pending'])->default('Pending');
            $table->enum('captain_status',['Active','DeActive'])->default('Active');
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captains');
    }
};
