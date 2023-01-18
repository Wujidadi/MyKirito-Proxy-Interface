<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('使用者帳號');
            $table->string('password')->comment('密碼');
            $table->rememberToken()->comment('記住我');
            $table->timestampTz('created_at', 6)->useCurrent()->comment('建立時間');
            $table->timestampTz('updated_at', 6)->useCurrent()/*->useCurrentOnUpdate()*/->comment('更新時間');
        });
        DB::statement(<<<SQL
            CREATE TRIGGER auto_update_time BEFORE UPDATE ON public.users
                FOR EACH ROW EXECUTE FUNCTION public.update_timestamp();
            SQL);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
