<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nama_instansi')) {
                $table->string('nama_instansi')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'status_akun')) {
                $table->enum('status_akun', ['aktif', 'nonaktif'])->default('aktif')->after('role');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('users', 'nama_instansi')) {
                $columnsToDrop[] = 'nama_instansi';
            }
            if (Schema::hasColumn('users', 'status_akun')) {
                $columnsToDrop[] = 'status_akun';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
