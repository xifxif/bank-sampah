<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Transaksi Penyetoran') }}
            </h2>
            <a href="{{ route('bank-sampah.penyetoran.create') }}" 
               class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Penyetoran
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filter -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('bank-sampah.penyetoran.index') }}">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div>
                                <label for="tanggal_dari" class="block mb-1 text-sm font-medium text-gray-700">
                                    Tanggal Dari
                                </label>
                                <input type="date" 
                                       id="tanggal_dari" 
                                       name="tanggal_dari" 
                                       value="{{ request('tanggal_dari') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="tanggal_sampai" class="block mb-1 text-sm font-medium text-gray-700">
                                    Tanggal Sampai
                                </label>
                                <input type="date" 
                                       id="tanggal_sampai" 
                                       name="tanggal_sampai" 
                                       value="{{ request('tanggal_sampai') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="jenis_sampah_id" class="block mb-1 text-sm font-medium text-gray-700">
                                    Jenis Sampah
                                </label>
                                <select id="jenis_sampah_id" 
                                        name="jenis_sampah_id" 
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Jenis</option>
                                    @foreach($jenisSampah as $jenis)
                                        <option value="{{ $jenis->id }}" {{ request('jenis_sampah_id') == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="search" class="block mb-1 text-sm font-medium text-gray-700">
                                    Pencarian
                                </label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="No. Transaksi, Nama, No. Identitas"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div class="flex justify-end mt-4 space-x-2">
                            <a href="{{ route('bank-sampah.penyetoran.index') }}" 
                               class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                Reset
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        No. Transaksi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Penyetor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Jenis Sampah
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Berat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penyetoran as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->no_transaksi }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->tanggal_setor->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->nama_penyetor }}
                                            </div>
                                            @if($item->no_identitas)
                                                <div class="text-sm text-gray-500">
                                                    {{ $item->no_identitas }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->jenisSampah->nama_jenis }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ number_format($item->berat, 2) }} {{ $item->jenisSampah->satuan }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="{{ route('bank-sampah.penyetoran.show', $item) }}" 
                                               class="mr-3 text-blue-600 hover:text-blue-900">
                                                Detail
                                            </a>
                                            <a href="{{ route('bank-sampah.penyetoran.edit', $item) }}" 
                                               class="mr-3 text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>
                                            <form action="{{ route('bank-sampah.penyetoran.destroy', $item) }}" 
                                                  method="POST" 
                                                  class="inline-block"
                                                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                            Tidak ada data transaksi penyetoran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $penyetoran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>