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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_perusahaan_id');
            $table->foreignId('users_id');
            $table->string('nama_perusahaan', 100);
            $table->text('alamat');
            $table->text('detail_alamat');
            $table->string('no_telepon', 100);
            $table->string('email');
            $table->boolean('is_disabled')->default(false);
            $table->timestamps();

            $table->foreign('bidang_perusahaan_id')->references('id')
            ->on('bidang_perusahaan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('users_id')->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
