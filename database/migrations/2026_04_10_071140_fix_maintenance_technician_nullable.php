<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            // 1. Drop foreign key dulu (penting!)
            $table->dropForeign(['technician_id']);

            // 2. Ubah kolom menjadi nullable
            $table->foreignId('technician_id')
                  ->nullable()
                  ->change();

            // 3. Tambahkan kembali foreign key dengan ON DELETE SET NULL
            $table->foreign('technician_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            $table->dropForeign(['technician_id']);

            $table->foreignId('technician_id')
                  ->nullable(false)
                  ->change();

            $table->foreign('technician_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')   // atau cascade, sesuaikan
                  ->onUpdate('cascade');
        });
    }
};
