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
        Schema::create('resource_role', function (Blueprint $table) {
            $table->foreignId('resource_id')->constrained()->onDelete("cascade");
            $table->foreignId('role_id')->constrained()->onDelete("cascade");
            $table->boolean('create')->default(false);
            $table->boolean("edit")->default(false);
            $table->boolean("delete")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_role');
    }
};
