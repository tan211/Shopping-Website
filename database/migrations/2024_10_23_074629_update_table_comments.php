<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->string('cmt')->after('id');
            $table->integer('id_blog')->after('cmt');
            $table->integer('id_user')->after('id_blog');
            $table->string('avatar')->after('id_user');
            $table->string('name')->after('avatar');
            $table->unsignedInteger('level')->default(0)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            //
        });
    }
};
