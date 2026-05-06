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

        $surats = Surat::with('user')->latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'surats'));
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
