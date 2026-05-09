<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    public function index()
    {
        $surats = SuratKeluar::where('tujuan_opd_id', Auth::id())
            ->with('pengirim')
            ->latest()
            ->paginate(15);
            
        return view('opd.surat-masuk.index', compact('surats'));
    }

    public function show($id)
    {
        $surat = SuratKeluar::with('pengirim')
            ->where('id', $id)
            ->where('tujuan_opd_id', Auth::id())
            ->firstOrFail();
            
        return view('opd.surat-masuk.show', compact('surat'));
    }
}
