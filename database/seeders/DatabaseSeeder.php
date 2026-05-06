<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin Kominfo
        User::create([
            'name' => 'Admin Kominfo',
            'email' => 'admin@kominfo.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Admin OPD
        $opd = User::create([
            'name' => 'Admin OPD 1',
            'email' => 'opd1@opd.go.id',
            'password' => Hash::make('password'),
            'role' => 'opd',
        ]);

        // Contoh Surat
        \App\Models\Surat::create([
            'user_id' => $opd->id,
            'nomor_surat' => '001/KOMINFO/2024',
            'tujuan' => 'Dinas Kesehatan',
            'tanggal' => now(),
            'keterangan' => 'Surat permohonan kerjasama.',
            'file' => 'surat/sample.pdf',
            'status' => 'pending',
        ]);

        \App\Models\Surat::create([
            'user_id' => $opd->id,
            'nomor_surat' => '002/KOMINFO/2024',
            'tujuan' => 'Dinas Pendidikan',
            'tanggal' => now(),
            'keterangan' => 'Surat undangan rapat.',
            'file' => 'surat/sample.pdf',
            'status' => 'selesai',
        ]);
    }
}
