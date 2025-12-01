<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Laporan Tahunan') }} - {{ $tahun }}
            </h2>
            <div class="flex space-x-2">
                <form action="{{ route('bank-sampah.laporan.tahunan') }}" method="GET" class="inline">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="download" value="1">
                </form>
                <a href="{{ route('bank-sampah.laporan.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi Penyetoran</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $summary['total_penyetoran'] }}</p>
                    <p class="mt-2 text-sm text-gray-600">{{ number_format($summary['total_berat_penyetoran'], 2) }} Kg</p>
                </div>
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Nilai Penyetoran</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($summary['total_nilai_penyetoran'], 0, ',', '.') }}</p>
                </div>
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi Penjualan</p>
                    <p class="text-3xl font-bold text-green-600">{{ $summary['total_penjualan'] }}</p>
                    <p class="mt-2 text-sm text-gray-600">{{ number_format($summary['total_berat_penjualan'], 2) }} Kg</p>
                </div>
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Nilai Penjualan</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($summary['total_nilai_penjualan'], 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Grafik/Tabel Bulanan -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Rekap Bulanan Tahun {{ $tahun }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Bulan</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase" colspan="3">Penyetoran</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase" colspan="3">Penjualan</th>
                                </tr>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3"></th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500">Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500">Berat (Kg)</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500">Nilai (Rp)</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500">Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500">Berat (Kg)</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500">Nilai (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($dataBulanan as $data)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                            {{ $namaBulan[$data['bulan']] }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $data['total_penyetoran'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($data['total_berat_penyetoran'], 2) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($data['total_nilai_penyetoran'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $data['total_penjualan'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($data['total_berat_penjualan'], 2) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($data['total_nilai_penjualan'], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">Total</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ $summary['total_penyetoran'] }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ number_format($summary['total_berat_penyetoran'], 2) }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ number_format($summary['total_nilai_penyetoran'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ $summary['total_penjualan'] }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ number_format($summary['total_berat_penjualan'], 2) }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ number_format($summary['total_nilai_penjualan'], 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Chart Visual (Optional) -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Grafik Penyetoran -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">Tren Penyetoran</h3>
                        <div class="space-y-3">
                            @foreach($dataBulanan as $data)
                                @php
                                    $maxNilai = max(array_column($dataBulanan, 'total_nilai_penyetoran'));
                                    $percentage = $maxNilai > 0 ? ($data['total_nilai_penyetoran'] / $maxNilai * 100) : 0;
                                @endphp
                                <div>
                                    <div class="flex justify-between mb-1 text-sm">
                                        <span class="font-medium text-gray-700">{{ $namaBulan[$data['bulan']] }}</span>
                                        <span class="text-gray-600">Rp {{ number_format($data['total_nilai_penyetoran'], 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Grafik Penjualan -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">Tren Penjualan</h3>
                        <div class="space-y-3">
                            @foreach($dataBulanan as $data)
                                @php
                                    $maxNilai = max(array_column($dataBulanan, 'total_nilai_penjualan'));
                                    $percentage = $maxNilai > 0 ? ($data['total_nilai_penjualan'] / $maxNilai * 100) : 0;
                                @endphp
                                <div>
                                    <div class="flex justify-between mb-1 text-sm">
                                        <span class="font-medium text-gray-700">{{ $namaBulan[$data['bulan']] }}</span>
                                        <span class="text-gray-600">Rp {{ number_format($data['total_nilai_penjualan'], 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>