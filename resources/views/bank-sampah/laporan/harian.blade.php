<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Laporan Harian') }} - {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
            </h2>
            <div class="flex space-x-2">
                <form action="{{ route('bank-sampah.laporan.harian') }}" method="GET" class="inline">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
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
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <!-- Total Penyetoran -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Penyetoran</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $summary['total_penyetoran'] }}</p>
                                <p class="text-sm text-gray-600">{{ number_format($summary['total_berat_penyetoran'], 2) }} Kg</p>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500">Nilai Transaksi</p>
                            <p class="text-lg font-bold text-blue-600">
                                Rp {{ number_format($summary['total_nilai_penyetoran'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Penjualan -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-green-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $summary['total_penjualan'] }}</p>
                                <p class="text-sm text-gray-600">{{ number_format($summary['total_berat_penjualan'], 2) }} Kg</p>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500">Nilai Transaksi</p>
                            <p class="text-lg font-bold text-green-600">
                                Rp {{ number_format($summary['total_nilai_penjualan'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Selisih -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-purple-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Selisih Nilai</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    @php
                                        $selisih = $summary['total_nilai_penjualan'] - $summary['total_nilai_penyetoran'];
                                    @endphp
                                    {{ $selisih >= 0 ? '+' : '' }} Rp {{ number_format(abs($selisih), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500">Selisih Berat</p>
                            <p class="text-lg font-bold {{ $summary['total_berat_penjualan'] - $summary['total_berat_penyetoran'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($summary['total_berat_penjualan'] - $summary['total_berat_penyetoran'], 2) }} Kg
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Penyetoran -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Transaksi Penyetoran</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No. Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Penyetor</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Harga/Satuan</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penyetoran as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->no_transaksi }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->nama_penyetor }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenisSampah->nama_jenis }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($item->berat, 2) }} {{ $item->jenisSampah->satuan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">Rp {{ number_format($item->harga_per_satuan, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500">Tidak ada transaksi penyetoran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Transaksi Penjualan -->
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Transaksi Penjualan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No. Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Pembeli</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Harga/Satuan</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penjualan as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->no_transaksi }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->pembeli }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenisSampah->nama_jenis }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($item->berat, 2) }} {{ $item->jenisSampah->satuan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">Rp {{ number_format($item->harga_jual_per_satuan, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500">Tidak ada transaksi penjualan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>