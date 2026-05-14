<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pembayaran_unit', function (Blueprint $table) {

            $table->id();

            // RELASI SANTRI
            $table->unsignedBigInteger('santri_id');

            // UNIT PEMBAYARAN
            $table->string('nama_unit');

            // NOMINAL
            $table->bigInteger('nominal')->default(0);

            // TANGGAL BAYAR
            $table->date('tanggal_bayar')->nullable();

            // KETERANGAN
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('santri_id')
                ->references('santri_id')
                ->on('santri')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_unit');
    }
}
