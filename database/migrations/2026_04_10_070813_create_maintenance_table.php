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
       Schema::create('maintenance', function (Blueprint $table) {
    $table->id();

    $table->foreignId('machine_id')
          ->constrained('machines')
          ->onDelete('restrict')
          ->onUpdate('cascade');

    $table->foreignId('technician_id')
          ->nullable()                    // ← Ini yang penting
          ->constrained('users')
          ->onDelete('set null')          // ← Aman sekarang
          ->onUpdate('cascade');

    $table->enum('maintenance_type', ['preventive', 'corrective'])->notNullable();
    $table->text('description')->nullable();
    $table->date('maintenance_date');
    $table->decimal('cost', 12, 2)->nullable()->default(0.00);
    $table->text('notes')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
