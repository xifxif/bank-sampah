<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Monitoring Per Wilayah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <div class="mb-6">
                        <p class="text-gray-600">
                            Monitoring kinerja bank sampah dan transaksi per wilayah di Kabupaten/Kota.
                        </p>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <div class="text-sm text-blue-600">Total Wilayah</div>
                            <div class="text-2xl font-bold text-blue-900">{{ $wilayah->count() }}</div>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <div class="text-sm text-green-600">Total Bank Sampah</div>
                            <div class="text-2xl font-bold text-green-900">{{ $wilayah->sum('bank_sampah_count') }}</div>
                        </div>
                        <div class="p-4 bg-purple-50 rounded-lg">
                            <div class="text-sm text-purple-600">Bank Aktif</div>
                            <div class="text-2xl font-bold text-purple-900">{{ $wilayah->sum('bank_sampah_aktif_count') }}</div>
                        </div>
                        <div class="p-4 bg-yellow-50 rounded-lg">
                            <div class="text-sm text-yellow-600">Total Nilai Transaksi</div>
                            <div class="text-lg font-bold text-yellow-900">
                                Rp {{ number_format($wilayah->sum('total_nilai'), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Wilayah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Total Bank</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Bank Aktif</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase">Nilai Penyetoran</th>
                                    <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase">Nilai Penjualan</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Performa</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($wilayah as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->nama_wilayah }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->kode_wilayah }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">
                                        <span class="font-semibold">{{ $item->bank_sampah_count }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                        <span class="font-semibold text-green-600">{{ $item->bank_sampah_aktif_count }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @php
                                            $percentage = $item->bank_sampah_count > 0 
                                                ? ($item->bank_sampah_aktif_count / $item->bank_sampah_count) * 100 
                                                : 0;
                                        @endphp
                                        @if($percentage >= 80)
                                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                Sangat Baik
                                            </span>
                                        @elseif($percentage >= 60)
                                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                Baik
                                            </span>
                                        @elseif($percentage >= 40)
                                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                Cukup
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                Perlu Perhatian
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-right text-gray-900 whitespace-nowrap">
                                        Rp {{ number_format($item->total_nilai, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-right text-gray-900 whitespace-nowrap">
                                        Rp {{ number_format($item->total_penjualan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            @php
                                                $avgPerBank = $item->bank_sampah_aktif_count > 0 
                                                    ? $item->total_nilai / $item->bank_sampah_aktif_count 
                                                    : 0;
                                            @endphp
                                            <div class="text-xs text-gray-600">
                                                <div class="font-medium">Rata-rata per Bank</div>
                                                <div class="text-blue-600">Rp {{ number_format($avgPerBank, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data wilayah</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-100">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-sm font-bold text-gray-900">TOTAL</td>
                                    <td class="px-6 py-4 text-sm font-bold text-center text-gray-900">
                                        {{ $wilayah->sum('bank_sampah_count') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-center text-green-600">
                                        {{ $wilayah->sum('bank_sampah_aktif_count') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-center text-gray-900">
                                        @php
                                            $totalPercentage = $wilayah->sum('bank_sampah_count') > 0
                                                ? ($wilayah->sum('bank_sampah_aktif_count') / $wilayah->sum('bank_sampah_count')) * 100
                                                : 0;
                                        @endphp
                                        {{ number_format($totalPercentage, 1) }}%
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">
                                        Rp {{ number_format($wilayah->sum('total_nilai'), 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">
                                        Rp {{ number_format($wilayah->sum('total_penjualan'), 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Chart Section -->
                    <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                        <!-- Top 5 Wilayah -->
                        <div class="p-4 border rounded-lg">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900">Top 5 Wilayah (Nilai Transaksi)</h3>
                            <div class="space-y-3">
                                @foreach($wilayah->take(5) as $index => $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center flex-1">
                                        <span class="flex items-center justify-center w-8 h-8 mr-3 text-sm font-bold text-white bg-blue-500 rounded-full">
                                            {{ $index + 1 }}
                                        </span>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $item->nama_wilayah }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->bank_sampah_aktif_count }} bank aktif</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($item->total_nilai / 1000000, 1) }}jt
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php
                                        $maxValue = $wilayah->max('total_nilai');
                                        $percentage = $maxValue > 0 ? ($item->total_nilai / $maxValue) * 100 : 0;
                                    @endphp
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Status Bank per Wilayah -->
                        <div class="p-4 border rounded-lg">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900">Status Bank Sampah per Wilayah</h3>
                            <div class="space-y-3">
                                @foreach($wilayah->take(5) as $item)
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $item->nama_wilayah }}</span>
                                        <span class="text-xs text-gray-500">
                                            {{ $item->bank_sampah_aktif_count }}/{{ $item->bank_sampah_count }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @php
                                            $activePercentage = $item->bank_sampah_count > 0 
                                                ? ($item->bank_sampah_aktif_count / $item->bank_sampah_count) * 100 
                                                : 0;
                                        @endphp
                                        <div class="h-2 rounded-full {{ $activePercentage >= 80 ? 'bg-green-500' : ($activePercentage >= 60 ? 'bg-blue-500' : ($activePercentage >= 40 ? 'bg-yellow-500' : 'bg-red-500')) }}" 
                                             style="width: {{ $activePercentage }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>