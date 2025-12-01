<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Admin - DLH') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Bank Sampah -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Bank Sampah</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $totalBankSampah }}</div>
                                        <div class="ml-2 text-sm text-gray-600">({{ $totalBankSampahAktif }} aktif)</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi Penyetoran -->
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
                                    <dt class="text-sm font-medium text-gray-500 truncate">Transaksi Penyetoran</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalPenyetoran) }}</div>
                                        <div class="ml-2 text-sm text-green-600">({{ $penyetoranBulanIni }} bulan ini)</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Berat Sampah -->
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
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Berat Sampah</dt>
                                    <dd>
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalBeratPenyetoran, 2) }} kg</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Nilai Ekonomis -->
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
                                    <dt class="text-sm font-medium text-gray-500 truncate">Nilai Ekonomis</dt>
                                    <dd>
                                        <div class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalNilaiPenyetoran, 0, ',', '.') }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Tables Row -->
            <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
                <!-- Chart Transaksi 7 Hari -->
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Transaksi 7 Hari Terakhir</h3>
                    <!-- Container dengan tinggi tetap -->
                    <div class="relative" style="height: 300px;">
                        <canvas id="chartTransaksi"></canvas>
                    </div>
                </div>

                <!-- Top 5 Jenis Sampah -->
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Jenis Sampah Terbanyak</h3>
                    <div class="space-y-3">
                        @forelse($jenisSampahTerbanyak as $index => $item)
                        <div class="flex items-center">
                            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 font-bold text-white bg-blue-500 rounded-full">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->jenisSampah->nama_jenis }}</div>
                                <div class="text-sm text-gray-500">{{ number_format($item->total_berat, 2) }} kg</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($item->jenisSampah->harga_standar * $item->total_berat, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        @empty
                        <p class="py-4 text-center text-gray-500">Belum ada data</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Bank Sampah Paling Aktif -->
            <div class="p-6 mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">Bank Sampah Paling Aktif</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Bank</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Wilayah</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total Transaksi</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bankSampahAktif as $index => $bank)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $bank->nama_bank }}</div>
                                    <div class="text-sm text-gray-500">{{ $bank->kode_bank }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $bank->wilayah->nama_wilayah ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $bank->transaksi_penyetoran_count + $bank->transaksi_penjualan_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($bank->status == 'aktif') bg-green-100 text-green-800 
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($bank->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data</td>
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
        // Chart Transaksi dengan konfigurasi yang benar
        const ctx = document.getElementById('chartTransaksi').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['dates']),
                datasets: [{
                    label: 'Penyetoran',
                    data: @json($chartData['penyetoran']),
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.3,
                    fill: true
                }, {
                    label: 'Penjualan',
                    data: @json($chartData['penjualan']),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 10,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    </script>
    @endpush
</x-app-layout>