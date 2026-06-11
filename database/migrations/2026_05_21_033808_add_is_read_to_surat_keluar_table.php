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
        if (!Schema::hasColumn('surat_keluar', 'is_read')) {
            Schema::table('surat_keluar', function (Blueprint $table) {
                $table->boolean('is_read')->default(false)->after('file');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('surat_keluar', 'is_read')) {
            Schema::table('surat_keluar', function (Blueprint $table) {
                $table->dropColumn('is_read');
            });
        }
    }
};
