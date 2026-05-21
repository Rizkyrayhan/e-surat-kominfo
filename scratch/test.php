<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Surat;
use App\Models\SuratKeluar;

echo "Cleaning up invalid records where file = '0'...\n";
$deletedSurat = Surat::where('file', '0')->forceDelete();
echo "Deleted {$deletedSurat} from Surat.\n";

$deletedSuratKeluar = SuratKeluar::where('file', '0')->forceDelete();
echo "Deleted {$deletedSuratKeluar} from SuratKeluar.\n";
