<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('machine_id');
            $table->enum('maintenance_type', ['preventive', 'corrective']);
            $table->text('description');
            $table->date('maintenance_date');

            // technician_id harus nullable karena pakai SET NULL
            $table->unsignedBigInteger('technician_id')->nullable();

            $table->decimal('cost', 12, 2);
            $table->text('notes')->nullable();

            $table->timestamp('created_at')->useCurrent();

            // Foreign Keys
            $table->foreign('machine_id')
                  ->references('id')
                  ->on('machines')
                  ->onDelete('cascade');     // biasanya mesin dihapus → maintenance ikut terhapus

            $table->foreign('technician_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');    // teknisi dihapus → technician_id jadi NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
