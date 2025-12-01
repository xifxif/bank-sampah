<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Laporan Bulanan') }} - {{ $namaBulan[$bulan] }} {{ $tahun }}
            </h2>
            <div class="flex space-x-2">
                <form action="{{ route('bank-sampah.laporan.bulanan') }}" method="GET" class="inline">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
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

            <!-- Rekap Per Jenis Sampah -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Rekap Penyetoran Per Jenis Sampah</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Jenis Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Total Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Total Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penyetoranPerJenis as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $item['jenis']->nama_jenis }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item['total_transaksi'] }} transaksi</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($item['total_berat'], 2) }} {{ $item['jenis']->satuan }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">Rp {{ number_format($item['total_nilai'], 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">Total</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ $summary['total_penyetoran'] }} transaksi</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ number_format($summary['total_berat_penyetoran'], 2) }} Kg</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">Rp {{ number_format($summary['total_nilai_penyetoran'], 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detail Transaksi Penyetoran -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Detail Transaksi Penyetoran</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">No. Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Penyetor</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Jenis Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penyetoran as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->tanggal_setor->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->no_transaksi }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->nama_penyetor }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenisSampah->nama_jenis }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($item->berat, 2) }} {{ $item->jenisSampah->satuan }}</td>
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

            <!-- Detail Transaksi Penjualan -->
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Detail Transaksi Penjualan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">No. Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Pembeli</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Jenis Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penjualan as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->tanggal_jual->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->no_transaksi }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->pembeli }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenisSampah->nama_jenis }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ number_format($item->berat, 2) }} {{ $item->jenisSampah->satuan }}</td>
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