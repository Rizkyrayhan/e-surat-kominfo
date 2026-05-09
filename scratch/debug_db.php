<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SuratKeluar;
use App\Models\User;

$surats = SuratKeluar::all();
echo "Total Surat Keluar: " . $surats->count() . "\n";
foreach ($surats as $s) {
    echo "ID: {$s->id}, Nomor: {$s->nomor_surat}, Tujuan ID: {$s->tujuan_opd_id}, File: {$s->file}\n";
}

$opds = User::where('role', 'opd')->get();
echo "\nTotal OPD: " . $opds->count() . "\n";
foreach ($opds as $o) {
    echo "ID: {$o->id}, Name: {$o->name}\n";
}
