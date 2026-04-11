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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();                    // BIGINT AUTO_INCREMENT PRIMARY KEY (Laravel default sejak v8+)

            $table->foreignId('machine_id')
                  ->constrained('machines')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('alert_type', [
                'maintenance_due',
                'overuse',
                'damage',
                'error',
                'warning'
            ])->default('warning');

            $table->enum('severity', [
                'low',
                'medium',
                'high',
                'critical'
            ])->default('medium');

            $table->string('title', 255);
            $table->text('message');

            $table->json('metadata')->nullable();   // Data tambahan fleksibel

            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();

            $table->boolean('resolved')->default(false);
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users');

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();   // created_at & updated_at otomatis

            // Index untuk performa query yang sering digunakan
            $table->index(['machine_id', 'alert_type', 'created_at']);
            $table->index(['is_read', 'created_at'], 'idx_unread');
            $table->index(['severity', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
