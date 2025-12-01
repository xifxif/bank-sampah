<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\BankSampah;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'bankSampah'])
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $bankSampah = BankSampah::active()->orderBy('nama_bank')->get();

        return view('admin.users.create', compact('roles', 'bankSampah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'bank_sampah_id' => ['nullable', 'exists:bank_sampah,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bank_sampah_id' => $request->role === 'bank_sampah' ? $request->bank_sampah_id : null,
            'email_verified_at' => now(),
        ]);

        $user->assignRole($request->role);

        LogAktivitas::logCreate(
            'users',
            'User baru dibuat: ' . $user->name,
            $user->toArray()
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->load(['roles', 'bankSampah', 'transaksiPenyetoran', 'transaksiPenjualan']);

        $totalTransaksi = $user->transaksiPenyetoran->count() + $user->transaksiPenjualan->count();

        return view('admin.users.show', compact('user', 'totalTransaksi'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $bankSampah = BankSampah::active()->orderBy('nama_bank')->get();

        return view('admin.users.edit', compact('user', 'roles', 'bankSampah'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'bank_sampah_id' => ['nullable', 'exists:bank_sampah,id'],
        ]);

        $oldData = $user->toArray();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'bank_sampah_id' => $request->role === 'bank_sampah' ? $request->bank_sampah_id : null,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles([$request->role]);

        LogAktivitas::logUpdate(
            'users',
            'User diupdate: ' . $user->name,
            $oldData,
            $user->fresh()->toArray()
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $userName = $user->name;
        $userData = $user->toArray();

        $user->delete();

        LogAktivitas::logDelete(
            'users',
            'User dihapus: ' . $userName,
            $userData
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
