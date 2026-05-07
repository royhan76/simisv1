<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnakKeJSaudaraToSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('santri', function (Blueprint $table) {
            if (!Schema::hasColumn('santri', 'anak_ke')) {
                $table->unsignedInteger('anak_ke')->nullable();
            }

            if (!Schema::hasColumn('santri', 'j_saudara')) {
                $table->unsignedInteger('j_saudara')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santri', function (Blueprint $table) {
            if (Schema::hasColumn('santri', 'anak_ke')) {
                $table->dropColumn('anak_ke');
            }

            if (Schema::hasColumn('santri', 'j_saudara')) {
                $table->dropColumn('j_saudara');
            }
        });
    }
}

