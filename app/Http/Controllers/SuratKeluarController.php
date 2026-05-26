<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $surats = SuratKeluar::with('tujuanOpd')->latest()->paginate(15);
        return view('admin.surat-keluar.index', compact('surats'));
    }

    public function create()
    {
        $opds = User::where('role', 'opd')->orderBy('name')->get();
        return view('admin.surat-keluar.create', compact('opds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tujuan_opd_ids' => 'required|array',
            'tujuan_opd_ids.*' => 'exists:users,id',
            'perihal' => 'required|string|max:255',
            'file_pdf' => 'required|file|mimes:pdf|max:10240',
        ]);

        $file = $request->file('file_pdf');
        $filename = $file->getClientOriginalName();
        $filePath = $file->storeAs('surat_keluar', $filename, 's3');

        foreach ($request->tujuan_opd_ids as $opdId) {
            SuratKeluar::create([
                'nomor_surat' => $request->nomor_surat,
                'tanggal' => $request->tanggal,
                'tujuan_opd_id' => $opdId,
                'perihal' => $request->perihal,
                'file' => $filePath,
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.surat-keluar.index')->with('success', 'Surat berhasil dikirim ke OPD tujuan.');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat-keluar.index')->with('success', 'Surat berhasil dihapus.');
    }
}
