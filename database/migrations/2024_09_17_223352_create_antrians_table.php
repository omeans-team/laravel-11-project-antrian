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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_antrian')->nullable();
            $table->integer('no_antrian');
            $table->datetime('tanggal_antrian');
            $table->datetime('updated_antrian')->nullable();
            $table->integer('jumlah_dipanggil')->nullable();
            $table->integer('lama_antrian')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
