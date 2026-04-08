<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machine_usage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->date('usage_date')->nullable();
            $table->decimal('hours_used', 5, 2)->nullable();
            $table->decimal('total_hours', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('machine_id')
                  ->references('id')
                  ->on('machines')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machine_usage');
    }
};
