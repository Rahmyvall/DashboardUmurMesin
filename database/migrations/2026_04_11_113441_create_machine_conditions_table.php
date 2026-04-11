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
        Schema::create('machine_conditions', function (Blueprint $table) {
            $table->id();                    // AUTO_INCREMENT PRIMARY KEY

            $table->foreignId('machine_id')
                  ->constrained('machines')  // REFERENCES machines(id)
                  ->onDelete('cascade');     // opsional: hapus data kondisi jika machine dihapus

            $table->enum('condition_status', ['baik', 'warning', 'rusak']);

            $table->decimal('temperature', 5, 2);
            $table->decimal('vibration', 5, 2);
            $table->decimal('pressure', 5, 2);

            $table->timestamp('recorded_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP

            $table->timestamps(); // created_at & updated_at (opsional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_conditions');
    }
};
