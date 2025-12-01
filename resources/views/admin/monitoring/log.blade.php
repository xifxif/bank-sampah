<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Log Aktivitas Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <!-- Filter -->
                    <form method="GET" class="mb-6">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Modul</label>
                                <select name="modul" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Modul</option>
                                    <option value="auth" {{ request('modul') == 'auth' ? 'selected' : '' }}>Authentication</option>
                                    <option value="users" {{ request('modul') == 'users' ? 'selected' : '' }}>Users</option>
                                    <option value="bank_sampah" {{ request('modul') == 'bank_sampah' ? 'selected' : '' }}>Bank Sampah</option>
                                    <option value="transaksi_penyetoran" {{ request('modul') == 'transaksi_penyetoran' ? 'selected' : '' }}>Penyetoran</option>
                                    <option value="transaksi_penjualan" {{ request('modul') == 'transaksi_penjualan' ? 'selected' : '' }}>Penjualan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Bank Sampah</label>
                                <select name="bank_sampah_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Bank</option>
                                    @foreach($bankSampah as $bank)
                                        <option value="{{ $bank->id }}" {{ request('bank_sampah_id') == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->nama_bank }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Dari</label>
                                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Sampai</label>
                                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div class="flex justify-end mt-4 space-x-2">
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                Filter
                            </button>
                            <a href="{{ route('admin.monitoring.log') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Reset
                            </a>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Waktu</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">User</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Aktivitas</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Modul</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Deskripsi</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">IP Address</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($logs as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $log->user?->name ?? 'System' }}</div>
                                        @if($log->bankSampah)
                                            <div class="text-xs text-gray-500">{{ $log->bankSampah->nama_bank }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $colors = [
                                                'login' => 'bg-green-100 text-green-800',
                                                'logout' => 'bg-gray-100 text-gray-800',
                                                'create' => 'bg-blue-100 text-blue-800',
                                                'update' => 'bg-yellow-100 text-yellow-800',
                                                'delete' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $colors[$log->aktivitas] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($log->aktivitas) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ ucfirst(str_replace('_', ' ', $log->modul)) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ Str::limit($log->deskripsi, 60) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $log->ip_address }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada log aktivitas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>