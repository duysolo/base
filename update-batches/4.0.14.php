<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table(webed_db_prefix() . 'password_resets', function (Blueprint $table) {
    $table->dropColumn('expired_at');
});
