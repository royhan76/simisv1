<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            // relasi santri
            $table->unsignedBigInteger('santri_id');

            // relasi master pembayaran
            $table->unsignedBigInteger('master_pembayaran_id');

            // nominal pembayaran
            $table->bigInteger('nominal')->default(0);

            // bulan hijriyah
            $table->string('bulan')->nullable();

            // tahun hijriyah
            $table->string('tahun_hijriyah')->nullable();

            // tanggal bayar
            $table->date('tanggal_bayar')->nullable();

            // keterangan
            $table->text('keterangan')->nullable();

            // status
            $table->enum('status', ['lunas', 'belum'])
                ->default('lunas');

            $table->timestamps();

            // FK santri
            $table->foreign('santri_id')
                ->references('id')
                ->on('santri')
                ->onDelete('cascade');

            // FK master pembayaran
            $table->foreign('master_pembayaran_id')
                ->references('id')
                ->on('master_pembayarans')
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
        Schema::dropIfExists('pembayarans');
    }
}
