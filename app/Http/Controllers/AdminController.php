<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Surat::count(),
            'pending' => Surat::where('status', 'pending')->count(),
            'selesai' => Surat::where('status', 'selesai')->count(),
        ];

        $surats = Surat::whereIn('status', ['pending', 'diproses', 'dikirim'])->with('user')->latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'surats'));
    }

    public function history(Request $request)
    {
        $search = $request->input('search');
        $query = Surat::withTrashed()->with('user');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($qu) use ($search) {
                      $qu->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $surats = $query->latest()->paginate(15)->withQueryString();
        return view('admin.history', compact('surats'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Surat::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Surat berhasil dihapus dari dashboard.']);
        }
        return response()->json(['success' => false, 'message' => 'Tidak ada surat yang dipilih.'], 400);
    }

    public function show(Surat $surat)
    {
        $surat->load('user');
        return view('admin.detail', compact('surat'));
    }

    public function updateStatus(Request $request, Surat $surat)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        $surat->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status surat berhasil diperbarui.');
    }

    public function print(Surat $surat)
    {
        $surat->load('user');
        return view('admin.print-disposisi', compact('surat'));
    }
}
