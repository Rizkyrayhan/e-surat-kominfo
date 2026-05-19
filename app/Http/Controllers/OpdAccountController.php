<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OpdAccountController extends Controller
{
    public function index()
    {
        $accounts = User::where('role', 'opd')->orderBy('name')->get();
        return view('admin.opd_accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.opd_accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nama_instansi' => $request->nama_instansi,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'opd',
            'status_akun' => 'aktif',
        ]);

        return redirect()->route('admin.opd-accounts.index')->with('success', 'Akun OPD berhasil ditambahkan.');
    }

    public function edit(User $account)
    {
        if ($account->role !== 'opd') {
            abort(404);
        }
        return view('admin.opd_accounts.edit', compact('account'));
    }

    public function update(Request $request, User $account)
    {
        if ($account->role !== 'opd') {
            abort(404);
        }

        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $account->id,
        ]);

        $account->update([
            'nama_instansi' => $request->nama_instansi,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.opd-accounts.index')->with('success', 'Data Akun OPD berhasil diperbarui.');
    }

    public function resetPassword(Request $request, User $account)
    {
        if ($account->role !== 'opd') {
            abort(404);
        }

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $account->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.opd-accounts.index')->with('success', 'Password Akun OPD berhasil direset.');
    }

    public function toggleStatus(User $account)
    {
        if ($account->role !== 'opd') {
            abort(404);
        }

        $account->update([
            'status_akun' => $account->status_akun === 'aktif' ? 'nonaktif' : 'aktif',
        ]);

        return back()->with('success', 'Status Akun OPD berhasil diubah.');
    }

    public function destroy(User $account)
    {
        if ($account->role !== 'opd') {
            abort(404);
        }

        try {
            $account->delete();
            return redirect()->route('admin.opd-accounts.index')->with('success', 'Akun OPD berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.opd-accounts.index')->withErrors(['error' => 'Gagal menghapus akun. Akun ini mungkin sudah memiliki riwayat surat. Sebaiknya gunakan fitur Nonaktifkan.']);
        }
    }
}
