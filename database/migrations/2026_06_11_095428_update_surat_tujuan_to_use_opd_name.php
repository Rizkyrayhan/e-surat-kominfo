<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Surat;
use App\Models\SuratKeluar;
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
        // Alter tujuan column to TEXT to accommodate longer names without truncation
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `surat` MODIFY COLUMN `tujuan` TEXT');

        // Get all users keyed by their name to easily resolve names later as a fallback
        $usersMap = User::where('role', 'opd')->get()->keyBy('name');

        Surat::chunk(100, function ($surats) use ($usersMap) {
            foreach ($surats as $surat) {
                $tujuanArray = [];
                $originalTujuan = $surat->tujuan;

                // 1. Check if the original tujuan contains Dinas Komunikasi dan Informatika Bandar Lampung
                if (stripos($originalTujuan, 'Dinas Komunikasi') !== false || stripos($originalTujuan, 'Kominfo') !== false) {
                    $tujuanArray[] = 'Dinas Komunikasi dan Informatika Bandar Lampung';
                }

                // 2. Query surat_keluar to find any recipients of this letter
                $suratKeluars = SuratKeluar::with('tujuanOpd')
                    ->where('created_by', $surat->user_id)
                    ->where('nomor_surat', $surat->nomor_surat)
                    ->get();

                if ($suratKeluars->isNotEmpty()) {
                    foreach ($suratKeluars as $sk) {
                        if ($sk->tujuanOpd) {
                            $opdName = $sk->tujuanOpd->nama_instansi ?: $sk->tujuanOpd->name;
                            if ($opdName && !in_array($opdName, $tujuanArray)) {
                                $tujuanArray[] = $opdName;
                            }
                        }
                    }
                } else {
                    // Fallback: Parse the original tujuan string and map any name matching the user's name
                    $parts = array_map('trim', explode(',', $originalTujuan));
                    foreach ($parts as $part) {
                        if (empty($part)) continue;
                        if (stripos($part, 'Dinas Komunikasi') !== false || stripos($part, 'Kominfo') !== false) {
                            continue; // Already added above
                        }
                        
                        // Check if the part is a username of an OPD user
                        if (isset($usersMap[$part])) {
                            $opdName = $usersMap[$part]->nama_instansi ?: $usersMap[$part]->name;
                            if ($opdName && !in_array($opdName, $tujuanArray)) {
                                $tujuanArray[] = $opdName;
                            }
                        } else {
                            // If not found in users, just keep the original text
                            if (!in_array($part, $tujuanArray)) {
                                $tujuanArray[] = $part;
                            }
                        }
                    }
                }

                if (!empty($tujuanArray)) {
                    $newTujuan = implode(', ', $tujuanArray);
                    if ($newTujuan !== $originalTujuan) {
                        $surat->update(['tujuan' => $newTujuan]);
                    }
                }
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
        // No reverse operation needed for dynamic data cleanup
    }
};

