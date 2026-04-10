<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();                    // AUTO_INCREMENT PRIMARY KEY (id)

            $table->foreignId('machine_id')
                  ->constrained('machines')  // otomatis buat foreign key ke machines(id)
                  ->onDelete('cascade');     // opsional: hapus schedule jika machine dihapus

            $table->unsignedInteger('interval_hours');           // berapa jam sekali maintenance
            $table->decimal('last_maintenance_hours', 10, 2);    // total jam operasi saat maintenance terakhir
            $table->decimal('next_maintenance_hours', 10, 2);    // total jam operasi untuk maintenance berikutnya

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();

            // Index untuk mempercepat query
            $table->index('machine_id');
            $table->index('next_maintenance_hours');
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_schedules');
    }
};
