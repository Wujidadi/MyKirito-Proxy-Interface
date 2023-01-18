<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestampTz('last_used_at', 6)->nullable();
            $table->timestampTz('expires_at', 6)->nullable();
            $table->timestampTz('created_at', 6)->useCurrent();
            $table->timestampTz('updated_at', 6)->useCurrent();
        });
        DB::statement(<<<SQL
            CREATE TRIGGER auto_update_time BEFORE UPDATE ON public.personal_access_tokens
                FOR EACH ROW EXECUTE FUNCTION public.update_timestamp();
            SQL);
    }

    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
