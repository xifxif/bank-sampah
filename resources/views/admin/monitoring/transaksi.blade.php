<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Monitoring Transaksi Per Bank') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <!-- Filter -->
                    <form method="GET" class="mb-6">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Wilayah</label>
                                <select name="wilayah_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Wilayah</option>
                                    <!-- Add wilayah options -->
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Periode</label>
                                <select name="periode" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Waktu</option>
                                    <option value="hari_ini" {{ request('periode') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                    <option value="minggu_ini" {{ request('periode') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                    <option value="bulan_ini" {{ request('periode') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                    Filter
                                </button>
                                <a href="{{ route('admin.monitoring.transaksi') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Bank Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Wilayah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Penyetoran</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Penjualan</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Total Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($bankSampah as $index => $bank)
                                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $bank->nama_bank }}</div>
                                        <div class="text-xs text-gray-500">{{ $bank->kode_bank }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $bank->wilayah->nama_wilayah }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        <span class="font-semibold text-green-600">{{ $bank->transaksi_penyetoran_count ?? 0 }}</span> transaksi
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        <span class="font-semibold text-blue-600">{{ $bank->transaksi_penjualan_count ?? 0 }}</span> transaksi
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ number_format($bank->transaksi_penyetoran_sum_berat ?? 0, 2) }} kg
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                        Rp {{ number_format($bank->transaksi_penyetoran_sum_subtotal ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data transaksi</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-100">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-sm font-bold text-gray-900">TOTAL</td>
                                    <td class="px-6 py-4 text-sm font-bold text-green-600">
                                        {{ $bankSampah->sum('transaksi_penyetoran_count') }} transaksi
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-blue-600">
                                        {{ $bankSampah->sum('transaksi_penjualan_count') }} transaksi
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        {{ number_format($bankSampah->sum('transaksi_penyetoran_sum_berat'), 2) }} kg
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        Rp {{ number_format($bankSampah->sum('transaksi_penyetoran_sum_subtotal'), 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>