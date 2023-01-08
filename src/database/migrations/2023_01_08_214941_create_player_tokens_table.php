<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('player_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('player_name', 100)->unique()->comment('玩家暱稱');
            $table->string('player_id', 24)->unique()->comment('Token第1段，玩家ID');
            $table->string('section_2', 23)->comment('Token第2段，固定值');
            $table->string('section_3', 21)->comment('Token第3段，變動值');
            $table->timestampTz('created_at', 6)->useCurrent()->comment('建立時間');
            $table->timestampTz('updated_at', 6)->useCurrent()/*->useCurrentOnUpdate()*/->comment('更新時間');
        });
        DB::statement(<<<SQL
            CREATE TRIGGER auto_update_time BEFORE UPDATE ON public.player_tokens
                FOR EACH ROW EXECUTE FUNCTION public.update_timestamp();
            SQL);
    }

    public function down(): void
    {
        Schema::dropIfExists('player_tokens');
    }
};
