<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update user named 'Admin Kominfo'
        User::where('role', 'admin')->update([
            'name' => 'Dinas Komunikasi dan Informatika Bandar Lampung',
            'nama_instansi' => 'Dinas Komunikasi dan Informatika Bandar Lampung'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('role', 'admin')->update([
            'name' => 'Admin Kominfo',
            'nama_instansi' => null
        ]);
    }
};
