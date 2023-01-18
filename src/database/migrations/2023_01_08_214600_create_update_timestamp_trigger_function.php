<?php

use Illuminate\Database\Migrations\Migration;

return new class () extends Migration
{
    public function up(): void
    {
        DB::unprepared(<<<SQL
            CREATE OR REPLACE FUNCTION public.update_timestamp()
                RETURNS trigger
                LANGUAGE 'plpgsql'
            AS $$
            BEGIN
                new."updated_at" = CURRENT_TIMESTAMP;
                RETURN new;
            END
            $$;
            SQL);
    }

    public function down(): void
    {
        DB::unprepared(<<<SQL
            DROP FUNCTION IF EXISTS public.update_timestamp;
            SQL);
    }
};
