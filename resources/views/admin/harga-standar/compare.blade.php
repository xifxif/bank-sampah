<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Perbandingan Harga Standar vs Bank Sampah') }}
            </h2>
            <a href="{{ route('admin.harga-standar.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-600 border border-transparent rounded-md hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th rowspan="2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Kode
                                    </th>
                                    <th rowspan="2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Jenis Sampah
                                    </th>
                                    <th rowspan="2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Kategori
                                    </th>
                                    <th rowspan="2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Harga Standar
                                    </th>
                                    <th colspan="3" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase border-l">
                                        Harga Bank Sampah
                                    </th>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase border-l">
                                        Bank Sampah
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Harga
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Selisih
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($comparison as $item)
                                    @php
                                        $firstRow = true;
                                        $rowCount = max(1, $item['harga_banks']->count());
                                    @endphp
                                    
                                    @if($item['harga_banks']->isEmpty())
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                {{ $item['jenis']->kode_jenis }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                {{ $item['jenis']->nama_jenis }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                                    {{ ucfirst($item['jenis']->kategori) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                Rp {{ number_format($item['harga_standar'], 0, ',', '.') }}
                                            </td>
                                            <td colspan="3" class="px-6 py-4 text-sm text-center text-gray-500 border-l">
                                                <em>Belum ada harga bank sampah</em>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($item['harga_banks'] as $hargaBank)
                                            <tr>
                                                @if($firstRow)
                                                    <td rowspan="{{ $rowCount }}" class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                        {{ $item['jenis']->kode_jenis }}
                                                    </td>
                                                    <td rowspan="{{ $rowCount }}" class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                        {{ $item['jenis']->nama_jenis }}
                                                    </td>
                                                    <td rowspan="{{ $rowCount }}" class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                                            {{ ucfirst($item['jenis']->kategori) }}
                                                        </span>
                                                    </td>
                                                    <td rowspan="{{ $rowCount }}" class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                        Rp {{ number_format($item['harga_standar'], 0, ',', '.') }}
                                                    </td>
                                                    @php $firstRow = false; @endphp
                                                @endif
                                                
                                                <td class="px-6 py-4 text-sm text-gray-900 border-l whitespace-nowrap">
                                                    {{ $hargaBank->bankSampah->nama_bank ?? '-' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                    Rp {{ number_format($hargaBank->harga, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                                    @php
                                                        $selisih = $hargaBank->harga - $item['harga_standar'];
                                                        $persentase = $item['harga_standar'] > 0 ? ($selisih / $item['harga_standar']) * 100 : 0;
                                                    @endphp
                                                    
                                                    @if($selisih > 0)
                                                        <span class="font-medium text-green-600">
                                                            +Rp {{ number_format($selisih, 0, ',', '.') }}
                                                            ({{ number_format($persentase, 1) }}%)
                                                        </span>
                                                    @elseif($selisih < 0)
                                                        <span class="font-medium text-red-600">
                                                            Rp {{ number_format($selisih, 0, ',', '.') }}
                                                            ({{ number_format($persentase, 1) }}%)
                                                        </span>
                                                    @else
                                                        <span class="text-gray-600">
                                                            Sama
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                            Tidak ada data untuk ditampilkan
                                        </td>
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