<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Disposisi - {{ $surat->nomor_surat }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: white; font-family: 'Times New Roman', Times, serif; }
        .kop-surat { border-bottom: 3px double black; margin-bottom: 20px; }
        .table-disposisi th, .table-disposisi td { border: 1px solid black !important; padding: 10px; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 20px; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container my-4">
        <div class="no-print mb-4 text-center">
            <button onclick="window.print()" class="btn btn-primary">Cetak Lembar Disposisi</button>
            <a href="{{ route('admin.surat.show', $surat->id) }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="kop-surat text-center pb-3">
            <h4 class="mb-0 fw-bold">PEMERINTAH KABUPATEN / KOTA</h4>
            <h3 class="mb-0 fw-bold">DINAS KOMUNIKASI DAN INFORMATIKA</h3>
            <p class="mb-0 small">Jl. Jenderal Sudirman No. 123, Pusat Pemerintahan</p>
        </div>

        <h4 class="text-center fw-bold mb-4 text-decoration-underline">LEMBAR DISPOSISI</h4>

        <table class="table table-disposisi">
            <tr>
                <td width="30%"><strong>Surat Dari:</strong><br>{{ $surat->user->name }}</td>
                <td width="30%"><strong>Tanggal Surat:</strong><br>{{ $surat->tanggal->format('d/m/Y') }}</td>
                <td width="40%"><strong>Nomor Surat:</strong><br>{{ $surat->nomor_surat }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Perihal:</strong><br>{{ $surat->keterangan ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Diterima Tanggal:</strong><br>{{ $surat->created_at->format('d/m/Y') }}</td>
                <td><strong>Nomor Agenda:</strong><br>SK-{{ date('Y') }}-{{ str_pad($surat->id, 3, '0', STR_PAD_LEFT) }}</td>
            </tr>
        </table>

        <div class="row mt-4">
            <div class="col-6">
                <table class="table table-disposisi">
                    <tr><th>DITERUSKAN KEPADA:</th></tr>
                    <tr><td height="150px">
                        [ ] Sekretaris<br>
                        [ ] Kabid Pengelolaan Informasi<br>
                        [ ] Kabid Aplikasi Informatika<br>
                        [ ] Kabid Statistik
                    </td></tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-disposisi">
                    <tr><th>DISPOSISI / INSTRUKSI:</th></tr>
                    <tr><td height="150px">
                        Status Terakhir: <strong>{{ strtoupper($surat->status) }}</strong><br><br>
                        Catatan:<br>...........................................................
                    </td></tr>
                </table>
            </div>
        </div>

        <div class="mt-5 text-end pe-5">
            <p class="mb-0">Dicetak pada: {{ date('d/m/Y H:i') }}</p>
            <p class="mb-5">Kepala Dinas,</p>
            <br><br>
            <p class="fw-bold text-decoration-underline">( __________________________ )</p>
            <p>NIP. ....................................</p>
        </div>
    </div>
</body>
</html>
