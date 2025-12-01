<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Master Data Bank Sampah') }}
            </h2>
            <a href="{{ route('admin.bank-sampah.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Tambah Bank Sampah
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
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Wilayah</label>
                                <select name="wilayah_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Wilayah</option>
                                    @foreach($wilayah as $w)
                                        <option value="{{ $w->id }}" {{ request('wilayah_id') == $w->id ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                                <select name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Status</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Cari</label>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Kode, nama bank, atau pengelola..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                    Filter
                                </button>
                                <a href="{{ route('admin.bank-sampah.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
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
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Nama Bank</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Wilayah</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Pengelola</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Telepon</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($bankSampah as $bank)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $bank->kode_bank }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $bank->nama_bank }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($bank->alamat, 30) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $bank->wilayah->nama_wilayah }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $bank->nama_pengelola }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $bank->no_telepon ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($bank->status == 'aktif') bg-green-100 text-green-800 
                                            @elseif($bank->status == 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($bank->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="{{ route('admin.bank-sampah.show', $bank) }}" class="mr-3 text-blue-600 hover:text-blue-900">Detail</a>
                                        <a href="{{ route('admin.bank-sampah.edit', $bank) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('admin.bank-sampah.destroy', $bank) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus bank sampah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data bank sampah</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $bankSampah->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>