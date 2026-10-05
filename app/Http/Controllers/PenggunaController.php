<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Tampilkan daftar seluruh pengguna dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $pengguna = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('jabatan', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('pengguna.index', compact('pengguna', 'search'));
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'nip' => 'nullable|string|max:30|unique:users,nip',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'jabatan' => 'nullable|string|max:255',
            'role' => 'required|in:admin,pegawai',
            'tanda_tangan' => 'nullable|file|mimes:png,jpg,jpeg,svg|max:2048',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan.',
            'nip.unique' => 'NIP ini sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $signaturePath = null;
        if ($request->hasFile('tanda_tangan')) {
            $file = $request->file('tanda_tangan');
            $filename = 'ttd_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/signatures'), $filename);
            $signaturePath = 'uploads/signatures/' . $filename;
        }

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'nip' => $validated['nip'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'jabatan' => $validated['jabatan'] ?? null,
            'role' => $validated['role'],
            'tanda_tangan' => $signaturePath,
            'is_active' => true,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Perbarui data pengguna yang ada.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'nip' => 'nullable|string|max:30|unique:users,nip,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'jabatan' => 'nullable|string|max:255',
            'role' => 'required|in:admin,pegawai',
            'tanda_tangan' => 'nullable|file|mimes:png,jpg,jpeg,svg|max:2048',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah dipakai akun lain.',
            'nip.unique' => 'NIP sudah dipakai akun lain.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah dipakai akun lain.',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->nip = $validated['nip'] ?? null;
        $user->email = $validated['email'];
        $user->jabatan = $validated['jabatan'] ?? null;
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('tanda_tangan')) {
            $file = $request->file('tanda_tangan');
            $filename = 'ttd_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/signatures'), $filename);
            $user->tanda_tangan = 'uploads/signatures/' . $filename;
        }

        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna dari database.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user->username === 'admin_bps') {
            return back()->with('error', 'Akun Administrator utama tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
