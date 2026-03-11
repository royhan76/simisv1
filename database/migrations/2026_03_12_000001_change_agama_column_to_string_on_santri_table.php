<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('santri') || !Schema::hasColumn('santri', 'agama')) {
            return;
        }

        DB::statement('ALTER TABLE `santri` MODIFY `agama` VARCHAR(50) NULL');

        if (Schema::hasTable('agama')) {
            DB::statement(
                "UPDATE `santri` s
                 LEFT JOIN `agama` a ON a.id = s.agama
                 SET s.agama = COALESCE(a.agama, s.agama)
                 WHERE s.agama REGEXP '^[0-9]+$'"
            );
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('santri') || !Schema::hasColumn('santri', 'agama')) {
            return;
        }

        DB::statement("ALTER TABLE `santri` MODIFY `agama` BIGINT NOT NULL DEFAULT '0'");
    }
};

