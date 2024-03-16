<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE EVENT delete_old_users_event
        ON SCHEDULE EVERY 1 MINUTE
        DO
            DELETE FROM users
            WHERE first_login_at <= NOW() - INTERVAL 24 HOUR;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP EVENT IF EXISTS delete_old_users_event;');
    }
};
