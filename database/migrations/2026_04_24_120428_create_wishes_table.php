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
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name', 100);
            $table->string('sender_email', 150)->nullable();
            $table->text('message');
            $table->enum('relationship', [
                'family',
                'friend',
                'colleague',
                'church_member',
                'well_wisher',
            ])->default('well_wisher');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->string('ip_address', 45)->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index('is_approved');
            $table->index('is_featured');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishes');
    }
};
