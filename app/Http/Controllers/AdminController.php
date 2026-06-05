<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $counts = Surat::selectRaw("
            count(*) as total,
            sum(case when status = 'pending' then 1 else 0 end) as pending,
            sum(case when status = 'diproses' then 1 else 0 end) as diproses,
            sum(case when status = 'dikirim' then 1 else 0 end) as dikirim,
            sum(case when status = 'selesai' then 1 else 0 end) as selesai
        ")->first();

        $stats = [
            'total' => $counts->total ?? 0,
            'pending' => $counts->pending ?? 0,
            'diproses' => $counts->diproses ?? 0,
            'dikirim' => $counts->dikirim ?? 0,
            'selesai' => $counts->selesai ?? 0,
        ];

        $surats = Surat::whereIn('status', ['pending', 'diproses', 'dikirim'])->with('user')->latest()->paginate(10);
        $verifikators = User::where('role', 'admin')->get();

        return view('admin.dashboard', compact('stats', 'surats', 'verifikators'));
    }

    public function history(Request $request)
    {
        $search = $request->input('search');
        $query = Surat::with('user');

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
            Surat::whereIn('id', $ids)->forceDelete();
            return response()->json(['success' => true, 'message' => 'Surat berhasil dihapus secara permanen.']);
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
