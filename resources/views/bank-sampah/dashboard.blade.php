<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }} - {{ auth()->user()->bankSampah->nama_bank }}
            </h2>
            <div class="text-sm text-gray-600">
                <span class="font-medium">Wilayah:</span> {{ auth()->user()->bankSampah->wilayah->nama_wilayah }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
                <a href="{{ route('bank-sampah.penyetoran.create') }}" class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 hover:scale-105">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Tambah Penyetoran</h3>
                            <p class="text-sm opacity-90">Input transaksi penyetoran baru</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('bank-sampah.penjualan.create') }}" class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 hover:scale-105">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Tambah Penjualan</h3>
                            <p class="text-sm opacity-90">Input transaksi penjualan baru</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Penyetoran -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-green-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Penyetoran</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalPenyetoran) }}</div>
                                        <div class="ml-2 text-sm text-green-600">({{ $penyetoranBulanIni }})</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Berat -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-yellow-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                </svg>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Berat</dt>
                                    <dd>
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalBeratPenyetoran, 2) }}</div>
                                        <div class="text-sm text-gray-500">kg</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Nilai -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-purple-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Nilai Penyetoran</dt>
                                    <dd>
                                        <div class="text-lg font-semibold text-gray-900">Rp {{ number_format($totalNilaiPenyetoran, 0, ',', '.') }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Penjualan -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Penjualan</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalPenjualan) }}</div>
                                        <div class="ml-2 text-sm text-blue-600">({{ $penjualanBulanIni }})</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Recent Transactions -->
            <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
                <!-- Chart -->
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Transaksi 7 Hari Terakhir</h3>
                    <div style="position: relative; height: 300px;">
                        <canvas id="chartTransaksi"></canvas>
                    </div>
                </div>

                <!-- Jenis Sampah Terbanyak -->
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Top 5 Jenis Sampah</h3>
                    <div class="space-y-3">
                        @forelse($jenisSampahTerbanyak as $index => $item)
                        <div class="flex items-center">
                            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 font-bold text-white bg-green-500 rounded-full">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->jenisSampah->nama_jenis }}</div>
                                <div class="text-sm text-gray-500">{{ number_format($item->total_berat, 2) }} kg</div>
                            </div>
                        </div>
                        @empty
                        <p class="py-4 text-center text-gray-500">Belum ada data</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Transaksi Terbaru</h3>
                    <a href="{{ route('bank-sampah.penyetoran.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">No. Transaksi</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Penyetor</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Jenis Sampah</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Berat</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transaksiTerbaru as $transaksi)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $transaksi->no_transaksi }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $transaksi->tanggal_setor->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $transaksi->nama_penyetor }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $transaksi->jenisSampah->nama_jenis }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($transaksi->berat, 2) }} kg</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">Rp {{ number_format($transaksi->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartTransaksi').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartData['dates']),
                datasets: [{
                    label: 'Penyetoran',
                    data: @json($chartData['penyetoran']),
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                }, {
                    label: 'Penjualan',
                    data: @json($chartData['penjualan']),
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>