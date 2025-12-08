<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Master Data Wilayah') }}
            </h2>
            <a href="{{ route('admin.wilayah.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Tambah Wilayah
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
                                <label class="block mb-2 text-sm font-medium text-gray-700">Jenis Wilayah</label>
                                <select name="jenis" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Jenis</option>
                                    <option value="kecamatan" {{ request('jenis') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="kelurahan" {{ request('jenis') == 'kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                                    <option value="desa" {{ request('jenis') == 'desa' ? 'selected' : '' }}>Desa</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Cari</label>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Kode atau nama wilayah..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                    Filter
                                </button>
                                <a href="{{ route('admin.wilayah.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
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
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Wilayah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jumlah Bank Sampah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($wilayah as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $item->kode_wilayah }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->nama_wilayah }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                            {{ ucfirst($item->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">{{ $item->bank_sampah_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="{{ route('admin.wilayah.edit', $item) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('admin.wilayah.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus wilayah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data wilayah</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        @if(method_exists($wilayah, 'links'))
                            {{ $wilayah->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>