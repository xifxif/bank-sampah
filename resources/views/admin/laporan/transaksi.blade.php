<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laporan Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.laporan.transaksi') }}" class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div>
                                <x-label for="tanggal_dari" value="Tanggal Dari" />
                                <x-input id="tanggal_dari" type="date" name="tanggal_dari" 
                                         value="{{ request('tanggal_dari', date('Y-m-01')) }}" required class="block w-full mt-1" />
                            </div>
                            <div>
                                <x-label for="tanggal_sampai" value="Tanggal Sampai" />
                                <x-input id="tanggal_sampai" type="date" name="tanggal_sampai" 
                                         value="{{ request('tanggal_sampai', date('Y-m-d')) }}" required class="block w-full mt-1" />
                            </div>
                            <div>
                                <x-label for="bank_sampah_id" value="Bank Sampah (Opsional)" />
                                <select id="bank_sampah_id" name="bank_sampah_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Bank Sampah</option>
                                    @if(isset($bankSampahList))
                                        @foreach($bankSampahList as $bank)
                                            <option value="{{ $bank->id }}" {{ request('bank_sampah_id') == $bank->id ? 'selected' : '' }}>
                                                {{ $bank->nama_bank }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <x-label for="jenis_sampah_id" value="Jenis Sampah (Opsional)" />
                                <select id="jenis_sampah_id" name="jenis_sampah_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Jenis</option>
                                    @if(isset($jenisSampahList))
                                        @foreach($jenisSampahList as $jenis)
                                            <option value="{{ $jenis->id }}" {{ request('jenis_sampah_id') == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama_jenis }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
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

            @if(isset($summary))
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Penyetoran</p>
                                    <p class="text-2xl font-semibold text-gray-700">{{ $summary['total_penyetoran'] }}</p>
                                    <p class="text-sm text-gray-500">{{ number_format($summary['total_berat_penyetoran'], 2) }} kg</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-lg font-bold text-blue-600">
                                    Rp {{ number_format($summary['total_nilai_penyetoran'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-full">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                                    <p class="text-2xl font-semibold text-gray-700">{{ $summary['total_penjualan'] }}</p>
                                    <p class="text-sm text-gray-500">{{ number_format($summary['total_berat_penjualan'], 2) }} kg</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-lg font-bold text-green-600">
                                    Rp {{ number_format($summary['total_nilai_penjualan'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-purple-100 rounded-full">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Selisih</p>
                                    <p class="text-2xl font-semibold text-gray-700">
                                        {{ $summary['total_penjualan'] - $summary['total_penyetoran'] }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ number_format($summary['total_berat_penjualan'] - $summary['total_berat_penyetoran'], 2) }} kg
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-lg font-bold text-purple-600">
                                    Rp {{ number_format($summary['total_nilai_penjualan'] - $summary['total_nilai_penyetoran'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaksi Penyetoran -->
                <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Transaksi Penyetoran</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Bank Sampah</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Sampah</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Berat (kg)</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Harga/kg</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($penyetoran as $item)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                {{ $item->tanggal_setor->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->bankSampah->nama_bank }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenisSampah->nama_jenis }}</td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                {{ number_format($item->berat, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                Rp {{ number_format($item->harga_per_satuan, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-semibold text-right text-gray-900 whitespace-nowrap">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                                Tidak ada data penyetoran
                                            </td>
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
                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Transaksi Penjualan</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Bank Sampah</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Sampah</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Berat (kg)</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Harga/kg</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($penjualan as $item)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                {{ $item->tanggal_jual->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->bankSampah->nama_bank }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenisSampah->nama_jenis }}</td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                {{ number_format($item->berat, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-right text-gray-900 whitespace-nowrap">
                                                Rp {{ number_format($item->harga_jual_per_satuan, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-semibold text-right text-gray-900 whitespace-nowrap">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                                Tidak ada data penjualan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-lg font-medium">Pilih periode tanggal untuk menampilkan laporan</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>