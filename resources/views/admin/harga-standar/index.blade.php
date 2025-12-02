<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Harga Standar Sampah') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.harga-standar.compare') }}" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                    Bandingkan Harga
                </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <!-- Bulk Update -->
                    <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50">
                        <form action="{{ route('admin.harga-standar.bulk-update') }}" method="POST" onsubmit="return confirm('Yakin ingin mengupdate harga secara bulk?')">
                            @csrf
                            <div class="grid items-end grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        Persentase Perubahan (%)
                                    </label>
                                    <input type="number" name="persentase" step="0.1" required
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Contoh: 10 untuk naik 10%, -5 untuk turun 5%">
                                    <p class="mt-1 text-xs text-gray-500">Gunakan nilai positif untuk naik, negatif untuk turun</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        Pilih Jenis Sampah (Optional)
                                    </label>
                                    <select name="jenis_sampah_ids[]" multiple size="3"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($jenisSampah as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Kosongkan untuk update semua</p>
                                </div>
                                <div>
                                    <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                        Update Bulk
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Filter -->
                    <form method="GET" class="mb-6">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                                <select name="kategori" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Kategori</option>
                                    <option value="organik" {{ request('kategori') == 'organik' ? 'selected' : '' }}>Organik</option>
                                    <option value="anorganik" {{ request('kategori') == 'anorganik' ? 'selected' : '' }}>Anorganik</option>
                                    <option value="b3" {{ request('kategori') == 'b3' ? 'selected' : '' }}>B3</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Cari</label>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama jenis sampah..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                    Filter
                                </button>
                                <a href="{{ route('admin.harga-standar.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Nama Jenis</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Satuan</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Harga Standar</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($jenisSampah as $jenis)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $jenis->kode_jenis }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $jenis->nama_jenis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($jenis->kategori == 'organik') bg-green-100 text-green-800 
                                            @elseif($jenis->kategori == 'anorganik') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($jenis->kategori) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $jenis->satuan }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-green-600 whitespace-nowrap">
                                        Rp {{ number_format($jenis->harga_standar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="{{ route('admin.harga-standar.edit', $jenis) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Edit Harga
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $jenisSampah->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>