<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyahriyahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('syahriyah', function (Blueprint $table) {

            $table->id();

            // RELASI SANTRI
            $table->unsignedBigInteger('santri_id');

            // TAHUN HIJRIYAH
            $table->string('tahun_hijriyah');

            // BULAN
            $table->enum('bulan', [
                'Syawal',
                'Dzulqodah',
                'Dzulhijjah',
                'Muharram',
                'Shafar',
                'Rabiul Awal',
                'Rabiul Akhir',
                'Jumadil Awal',
                'Jumadil Akhir',
                'Rajab',
                'Syaban',
                'Ramadhan'
            ]);

            // NOMINAL SPP
            $table->bigInteger('nominal')->default(0);

            // TANGGAL BAYAR
            $table->date('tanggal_bayar')->nullable();

            // KETERANGAN
            $table->text('keterangan')->nullable();

            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syahriyah');
    }
}
