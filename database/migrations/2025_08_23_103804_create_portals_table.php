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
        Schema::create('portals', function (Blueprint $table) {
            $table->id();
            $table->string('UniversityName');
            $table->string('ProgramName');
            $table->string('Description')->nullable();
            $table->string('Link')->nullable();
            $table->date('ApplicationDeadline')->nullable();
            $table->enum("Status", ["Active", "Inactive"])->default("Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portals');
    }
};
