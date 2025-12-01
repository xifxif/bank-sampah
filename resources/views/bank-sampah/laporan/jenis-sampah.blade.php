<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Laporan Per Jenis Sampah') }} - {{ \Carbon\Carbon::parse(request('tanggal_dari'))->format('d M Y') }} s/d {{ \Carbon\Carbon::parse(request('tanggal_sampai'))->format('d M Y') }}
            </h2>
            <div class="flex space-x-2">
                <form action="{{ route('bank-sampah.laporan.jenis-sampah') }}" method="GET" class="inline">
                    <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
                    <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
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
                    <p class="text-sm font-medium text-gray-500">Total Jenis Sampah</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $summary['total_jenis'] }}</p>
                    <p class="mt-2 text-sm text-gray-600">Jenis yang terdata</p>
                </div>
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $summary['total_transaksi'] }}</p>
                    <p class="mt-2 text-sm text-gray-600">Transaksi penyetoran</p>
                </div>
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Berat</p>
                    <p class="text-3xl font-bold text-green-600">{{ number_format($summary['total_berat'], 2) }}</p>
                    <p class="mt-2 text-sm text-gray-600">Kilogram</p>
                </div>
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Nilai</p>
                    <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($summary['total_nilai'], 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Tabel Rekap Per Jenis -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Rekap Penyetoran Per Jenis Sampah</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total Transaksi</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total Berat</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total Nilai</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($data as $index => $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->jenisSampah->nama_jenis }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->jenisSampah->satuan }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $item->jenisSampah->kategori->nama_kategori }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ $item->total_transaksi }} transaksi
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                            {{ number_format($item->total_berat, 2) }} {{ $item->jenisSampah->satuan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                            Rp {{ number_format($item->total_nilai, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $percentage = $summary['total_nilai'] > 0 ? ($item->total_nilai / $summary['total_nilai'] * 100) : 0;
                                            @endphp
                                            <div class="flex items-center">
                                                <div class="flex-1">
                                                    <div class="w-full h-2 mr-2 bg-gray-200 rounded-full">
                                                        <div class="h-2 bg-indigo-600 rounded-full" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                </div>
                                                <span class="text-sm font-medium text-gray-900">{{ number_format($percentage, 1) }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                            Tidak ada data penyetoran dalam periode ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">Total</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ $summary['total_transaksi'] }} transaksi</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">{{ number_format($summary['total_berat'], 2) }} Kg</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">Rp {{ number_format($summary['total_nilai'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">100%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top 5 Jenis Sampah -->
            @if($data->count() > 0)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Berdasarkan Nilai -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">Top 5 Berdasarkan Nilai</h3>
                        <div class="space-y-4">
                            @foreach($data->take(5) as $index => $item)
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-full">
                                        <span class="text-sm font-bold text-indigo-600">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1 ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->jenisSampah->nama_jenis }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->total_transaksi }} transaksi • {{ number_format($item->total_berat, 2) }} {{ $item->jenisSampah->satuan }}</p>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Rp {{ number_format($item->total_nilai, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Berdasarkan Berat -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">Top 5 Berdasarkan Berat</h3>
                        <div class="space-y-4">
                            @foreach($data->sortByDesc('total_berat')->take(5)->values() as $index => $item)
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-100 rounded-full">
                                        <span class="text-sm font-bold text-green-600">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1 ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->jenisSampah->nama_jenis }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->total_transaksi }} transaksi • Rp {{ number_format($item->total_nilai, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">{{ number_format($item->total_berat, 2) }} {{ $item->jenisSampah->satuan }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>