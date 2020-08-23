<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailVerifiedAtToCdbUcMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdb_uc_members', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();
        });

        DB::table('cdb_uc_members')->update([
            'email_verified_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cdb_uc_members', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
        });
    }
}
