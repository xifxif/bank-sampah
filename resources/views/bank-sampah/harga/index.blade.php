<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Kelola Harga Sampah') }}
            </h2>
            <a href="{{ route('bank-sampah.harga.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Tetapkan Harga Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <!-- Info Banner -->
                    <div class="p-4 mb-6 border-l-4 border-blue-400 bg-blue-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Harga yang Anda tetapkan akan otomatis digunakan saat input transaksi penyetoran. 
                                    Jika belum menetapkan harga, sistem akan menggunakan harga standar dari DLH.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
                        <div class="p-4 border border-green-200 rounded-lg bg-green-50">
                            <p class="mb-1 text-sm text-gray-600">Harga Sudah Ditetapkan</p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $jenisSampah->filter(fn($j) => $j->hargaSampahBank->isNotEmpty())->count() }}
                            </p>
                            <p class="text-xs text-gray-500">dari {{ $jenisSampah->count() }} jenis sampah</p>
                        </div>
                        <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                            <p class="mb-1 text-sm text-gray-600">Belum Ditetapkan</p>
                            <p class="text-2xl font-bold text-yellow-600">
                                {{ $jenisSampah->filter(fn($j) => $j->hargaSampahBank->isEmpty())->count() }}
                            </p>
                            <p class="text-xs text-gray-500">menggunakan harga standar DLH</p>
                        </div>
                        <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                            <p class="mb-1 text-sm text-gray-600">Total Jenis Sampah</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $jenisSampah->count() }}</p>
                            <p class="text-xs text-gray-500">aktif di sistem</p>
                        </div>
                    </div>

                    <!-- Table by Category -->
                    @foreach(['organik', 'anorganik', 'b3'] as $kategori)
                        @php
                            $jenisKategori = $jenisSampah->where('kategori', $kategori);
                        @endphp
                        @if($jenisKategori->isNotEmpty())
                        <div class="mb-8">
                            <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold mr-2
                                    @if($kategori == 'organik') bg-green-100 text-green-800
                                    @elseif($kategori == 'anorganik') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($kategori) }}
                                </span>
                                <span class="text-sm text-gray-500">({{ $jenisKategori->count() }} jenis)</span>
                            </h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Jenis Sampah</th>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Satuan</th>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Harga Standar DLH</th>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Harga Bank Anda</th>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Selisih</th>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Berlaku</th>
                                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($jenisKategori as $jenis)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $jenis->nama_jenis }}</div>
                                                <div class="text-xs text-gray-500">{{ $jenis->kode_jenis }}</div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $jenis->satuan }}</td>
                                            <td class="px-4 py-3 text-sm font-medium text-green-600">
                                                Rp {{ number_format($jenis->harga_standar, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($jenis->hargaSampahBank->isNotEmpty())
                                                    <div class="text-sm font-bold text-blue-600">
                                                        Rp {{ number_format($jenis->hargaSampahBank->first()->harga, 0, ',', '.') }}
                                                    </div>
                                                @else
                                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                        Belum ditetapkan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($jenis->hargaSampahBank->isNotEmpty())
                                                    @php
                                                        $selisih = $jenis->hargaSampahBank->first()->harga - $jenis->harga_standar;
                                                        $persen = $jenis->harga_standar > 0 ? ($selisih / $jenis->harga_standar) * 100 : 0;
                                                    @endphp
                                                    @if($selisih > 0)
                                                        <span class="font-medium text-green-600">
                                                            +{{ number_format(abs($persen), 1) }}%
                                                        </span>
                                                    @elseif($selisih < 0)
                                                        <span class="font-medium text-red-600">
                                                            -{{ number_format(abs($persen), 1) }}%
                                                        </span>
                                                    @else
                                                        <span class="text-gray-500">0%</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-500">
                                                @if($jenis->hargaSampahBank->isNotEmpty())
                                                    {{ $jenis->hargaSampahBank->first()->tanggal_berlaku->format('d/m/Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm font-medium">
                                                @if($jenis->hargaSampahBank->isNotEmpty())
                                                    <a href="{{ route('bank-sampah.harga.edit', $jenis->hargaSampahBank->first()) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">
                                                        Update
                                                    </a>
                                                @else
                                                    <a href="{{ route('bank-sampah.harga.create') }}?jenis={{ $jenis->id }}" class="text-blue-600 hover:text-blue-900">
                                                        Tetapkan
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>