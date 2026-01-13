<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->integer('santri_id');
            $table->integer('no_induk');
            $table->integer('kk');
            $table->integer('nik');
            $table->integer('nis');
            $table->string('tmp_lahir');
            $table->timestamp('tgl_lahir');
            $table->string('nama');
            $table->string('khos');
            $table->string('status');
            $table->integer('alamat_id');
            $table->integer('kodepos');
            $table->integer('pend_terakhir_id');
            $table->integer('wali_id');
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
        Schema::dropIfExists('santri');
    }
}
