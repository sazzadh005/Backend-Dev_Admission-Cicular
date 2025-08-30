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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('portal_id')->constrained()->onDelete('cascade'); 

            // Additional fields
            $table->enum('status',['Pending','Approved','Rejected'])->default('Pending'); // applied, approved, rejected, etc.
            $table->timestamps();
            $table->unique(['user_id', 'portal_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
