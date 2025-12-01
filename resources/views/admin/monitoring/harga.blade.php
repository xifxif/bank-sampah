<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Monitoring Harga Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <div class="mb-6">
                        <p class="text-gray-600">
                            Perbandingan harga sampah antara harga standar DLH dengan harga yang ditetapkan oleh masing-masing Bank Sampah.
                        </p>
                    </div>

                    @forelse($monitoringHarga as $item)
                    <div class="pb-6 mb-8 border-b">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item['jenis']->nama_jenis }}</h3>
                                <p class="text-sm text-gray-500">{{ $item['jenis']->kode_jenis }} • {{ ucfirst($item['jenis']->kategori) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Harga Standar DLH</p>
                                <p class="text-xl font-bold text-green-600">Rp {{ number_format($item['harga_standar'], 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">per {{ $item['jenis']->satuan }}</p>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Bank Sampah</th>
                                        <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Harga Bank</th>
                                        <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Selisih</th>
                                        <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Persentase</th>
                                        <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Berlaku</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($item['harga_banks'] as $hargaBank)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            <div class="font-medium">{{ $hargaBank->bankSampah->nama_bank }}</div>
                                            <div class="text-xs text-gray-500">{{ $hargaBank->bankSampah->wilayah->nama_wilayah }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($hargaBank->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                                $selisih = $hargaBank->harga - $item['harga_standar'];
                                            @endphp
                                            <span class="{{ $selisih >= 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                                {{ $selisih >= 0 ? '+' : '' }}Rp {{ number_format(abs($selisih), 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                                $persentase = $item['harga_standar'] > 0 ? (($hargaBank->harga - $item['harga_standar']) / $item['harga_standar']) * 100 : 0;
                                            @endphp
                                            <span class="{{ $persentase >= 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                                {{ $persentase >= 0 ? '+' : '' }}{{ number_format($persentase, 1) }}%
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($hargaBank->harga > $item['harga_standar'] * 1.2)
                                                <span class="px-2 py-1 text-xs font-semibold text-orange-800 bg-orange-100 rounded-full">
                                                    Terlalu Tinggi
                                                </span>
                                            @elseif($hargaBank->harga < $item['harga_standar'] * 0.8)
                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                    Terlalu Rendah
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                    Normal
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            {{ $hargaBank->tanggal_berlaku->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-3 text-sm text-center text-gray-500">
                                            Belum ada bank yang menetapkan harga untuk jenis sampah ini
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center">
                        <p class="text-gray-500">Belum ada data monitoring harga</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>