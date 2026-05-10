<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OpdController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total' => Surat::where('user_id', $user->id)->count(),
            'pending' => Surat::where('user_id', $user->id)->where('status', 'pending')->count(),
            'diproses' => Surat::where('user_id', $user->id)->where('status', 'diproses')->count(),
            'selesai' => Surat::where('user_id', $user->id)->where('status', 'selesai')->count(),
        ];

        $surats = Surat::where('user_id', $user->id)->whereIn('status', ['pending', 'diproses', 'dikirim'])->latest()->take(10)->get();

        return view('opd.dashboard', compact('stats', 'surats'));
    }

    public function history(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $query = Surat::where('user_id', $user->id);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhere('tujuan', 'like', "%{$search}%");
            });
        }

        $surats = $query->latest()->paginate(15)->withQueryString();
        
        return view('opd.history', compact('surats'));
    }

    public function bulkDelete(Request $request)
    {
        $user = Auth::user();
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Surat::where('user_id', $user->id)->whereIn('id', $ids)->forceDelete();
            return response()->json(['success' => true, 'message' => 'Surat berhasil dihapus secara permanen.']);
        }
        return response()->json(['success' => false, 'message' => 'Tidak ada surat yang dipilih.'], 400);
    }

    public function create()
    {
        return view('opd.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:10240', // 10MB max PDF
        ]);

        $filePath = $request->file('file')->store('surat', 'public');

        Surat::create([
            'user_id' => Auth::id(),
            'nomor_surat' => $request->nomor_surat,
            'tujuan' => $request->tujuan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'file' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('opd.dashboard')->with('success', 'Surat berhasil diupload.');
    }
}
