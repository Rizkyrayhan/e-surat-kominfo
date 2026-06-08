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
        
        $counts = Surat::where('user_id', $user->id)
            ->selectRaw("
                count(*) as total,
                sum(case when status = 'pending' then 1 else 0 end) as pending,
                sum(case when status = 'diproses' then 1 else 0 end) as diproses,
                sum(case when status = 'selesai' then 1 else 0 end) as selesai
            ")->first();

        $stats = [
            'total' => $counts->total ?? 0,
            'pending' => $counts->pending ?? 0,
            'diproses' => $counts->diproses ?? 0,
            'selesai' => $counts->selesai ?? 0,
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

    public function show($id)
    {
        $surat = Surat::where('user_id', Auth::id())->findOrFail($id);
        return view('opd.detail', compact('surat'));
    }

    public function create()
    {
        $recentSurats = Surat::where('user_id', Auth::id())->latest()->take(2)->get();
        return view('opd.upload', compact('recentSurats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|max:10240', // 10MB max PDF
        ]);

        $file = $request->file('file');
        if (strtolower($file->getClientOriginalExtension()) !== 'pdf') {
            return back()->withErrors(['file' => 'Format file wajib .PDF'])->withInput();
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $safeName = time() . '_' . \Illuminate\Support\Str::slug($originalName) . '.' . $extension;
        $filePath = $file->storeAs('surat', $safeName, 's3');

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
