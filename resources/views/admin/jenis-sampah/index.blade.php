<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Master Data Jenis Sampah') }}
            </h2>
            <a href="{{ route('admin.jenis-sampah.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Tambah Jenis Sampah
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

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
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Kode atau nama jenis sampah..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                    Filter
                                </button>
                                <a href="{{ route('admin.jenis-sampah.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
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
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
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
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">Rp {{ number_format($jenis->harga_standar, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $jenis->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $jenis->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="{{ route('admin.jenis-sampah.show', $jenis) }}" class="mr-3 text-blue-600 hover:text-blue-900">Detail</a>
                                        <a href="{{ route('admin.jenis-sampah.edit', $jenis) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('admin.jenis-sampah.destroy', $jenis) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jenis sampah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data jenis sampah</td>
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