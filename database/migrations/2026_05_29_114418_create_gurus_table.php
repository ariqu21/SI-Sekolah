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
        Schema::create('gurus', function(Blueprint $table){
            $table->id();
            $table->string('nama_lengkap');
            $table->enum('jkelamin',['L','P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('NUPTK');
            $table->string('NIK');
            $table->string('pendidikan');
            $table->text('alamat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
