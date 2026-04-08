<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique()->nullable();
            $table->string('name', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('installation_date')->nullable();
            $table->integer('lifetime_hours')->nullable(); // umur ideal mesin (jam)
            $table->enum('status', ['aktif','maintenance','rusak'])->default('aktif');

            $table->foreignId('location_id')
                  ->constrained('locations')
                  ->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
