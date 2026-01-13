<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wali', function (Blueprint $table) {
            $table->id();
            $table->integer("santri_id");
            $table->integer("ayah_id");
            $table->integer("ayah_nik");
            $table->string("ayah");
            $table->integer("pend_terakhir_id_ayah");
            $table->timestamp("tgl_lahir_ayah");
            $table->integer("nik_ibu");
            $table->string("ibu");
            $table->string("tmp_lahir_ibu");
            $table->timestamp("tgl_lahir_ibu");
            $table->integer("pend_terakhir_id_ibu");
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
        Schema::dropIfExists('wali');
    }
}
