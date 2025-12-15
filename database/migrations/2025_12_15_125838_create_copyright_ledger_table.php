<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('copyright_ledger', function (Blueprint $table) {
            $table->id();

            // Relasi ke asset
            $table->unsignedBigInteger('asset_id');

            // Versi ledger
            $table->unsignedInteger('version');

            // Snapshot data hak cipta
            $table->jsonb('data');

            // Hash publik ledger (SHA-256)
            $table->string('ledger_hash', 64)->unique();

            $table->timestamps();

            // 1 asset tidak boleh punya versi sama
            $table->unique(['asset_id', 'version']);
        });

        // ===============================
        // IMMUTABLE LEDGER (Postgres)
        // ===============================

        // Function untuk menolak UPDATE & DELETE
        DB::statement("
            CREATE OR REPLACE FUNCTION prevent_copyright_ledger_update_delete()
            RETURNS trigger AS $$
            BEGIN
                RAISE EXCEPTION 'copyright_ledger is immutable. UPDATE or DELETE is not allowed.';
            END;
            $$ LANGUAGE plpgsql;
        ");

        // Trigger
        DB::statement("
            CREATE TRIGGER copyright_ledger_immutable
            BEFORE UPDATE OR DELETE ON copyright_ledger
            FOR EACH ROW
            EXECUTE FUNCTION prevent_copyright_ledger_update_delete();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop trigger & function dulu
        DB::statement("
            DROP TRIGGER IF EXISTS copyright_ledger_immutable ON copyright_ledger;
        ");

        DB::statement("
            DROP FUNCTION IF EXISTS prevent_copyright_ledger_update_delete();
        ");

        // Baru drop table
        Schema::dropIfExists('copyright_ledger');
    }
};
