<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laporan Jenis Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.laporan.jenis-sampah') }}" class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <x-label for="tanggal_dari" value="Tanggal Dari" />
                                <x-input id="tanggal_dari" type="date" name="tanggal_dari"
                                    value="{{ request('tanggal_dari') }}" required class="block w-full mt-1" />
                            </div>
                            <div>
                                <x-label for="tanggal_sampai" value="Tanggal Sampai" />
                                <x-input id="tanggal_sampai" type="date" name="tanggal_sampai"
                                    value="{{ request('tanggal_sampai') }}" required class="block w-full mt-1" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <x-button type="submit">
                                Tampilkan Laporan
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            @if (isset($summary))
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                                    <p class="text-2xl font-semibold text-gray-700">
                                        {{ number_format($summary['total_transaksi']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-full">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Berat</p>
                                    <p class="text-2xl font-semibold text-gray-700">
                                        {{ number_format($summary['total_berat'], 2) }} kg</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-yellow-100 rounded-full">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Nilai</p>
                                    <p class="text-2xl font-semibold text-gray-700">Rp
                                        {{ number_format($summary['total_nilai'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Detail Per Jenis Sampah</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Jenis Sampah</th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Kategori</th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                            Total Transaksi</th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                            Total Berat (kg)</th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                            Total Nilai</th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                            % Kontribusi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($jenisSampah as $item)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                {{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                {{ $item->nama_jenis }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                    {{ $item->kategori }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                {{ number_format($item->transaksi_count) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                {{ number_format($item->total_berat, 2) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-semibold text-right text-gray-900 whitespace-nowrap">
                                                Rp {{ number_format($item->total_nilai, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                {{ $summary['total_nilai'] > 0 ? number_format(($item->total_nilai / $summary['total_nilai']) * 100, 2) : 0 }}%
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-sm font-bold text-right text-gray-900">
                                            TOTAL</td>
                                        <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">
                                            {{ number_format($summary['total_transaksi']) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">
                                            {{ number_format($summary['total_berat'], 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">
                                            Rp {{ number_format($summary['total_nilai'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
