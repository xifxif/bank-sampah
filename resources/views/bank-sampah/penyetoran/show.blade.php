<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Detail Transaksi Penyetoran') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('bank-sampah.penyetoran.edit', $penyetoran) }}" 
                   class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('bank-sampah.penyetoran.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Informasi Transaksi -->
                        <div>
                            <h3 class="pb-2 mb-4 text-lg font-semibold text-gray-900 border-b">
                                Informasi Transaksi
                            </h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">No. Transaksi</label>
                                    <p class="text-base font-semibold text-gray-900">{{ $penyetoran->no_transaksi }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-500">Tanggal Setor</label>
                                    <p class="text-base text-gray-900">{{ $penyetoran->tanggal_setor->format('d F Y') }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-500">Dicatat Oleh</label>
                                    <p class="text-base text-gray-900">{{ $penyetoran->user->name }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-500">Bank Sampah</label>
                                    <p class="text-base text-gray-900">{{ $penyetoran->bankSampah->nama }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Penyetor -->
                        <div>
                            <h3 class="pb-2 mb-4 text-lg font-semibold text-gray-900 border-b">
                                Informasi Penyetor
                            </h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Nama Penyetor</label>
                                    <p class="text-base font-semibold text-gray-900">{{ $penyetoran->nama_penyetor }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-500">No. Identitas</label>
                                    <p class="text-base text-gray-900">{{ $penyetoran->no_identitas ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="pb-2 mb-4 text-lg font-semibold text-gray-900 border-b">
                            Detail Sampah
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Jenis Sampah</label>
                                <p class="text-base font-semibold text-gray-900">{{ $penyetoran->jenisSampah->nama_jenis }}</p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Kategori</label>
                                <p class="text-base text-gray-900">{{ $penyetoran->jenisSampah->kategori->nama_kategori }}</p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Berat</label>
                                <p class="text-base font-semibold text-gray-900">
                                    {{ number_format($penyetoran->berat, 2) }} {{ $penyetoran->jenisSampah->satuan }}
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Harga per {{ $penyetoran->jenisSampah->satuan }}</label>
                                <p class="text-base text-gray-900">
                                    Rp {{ number_format($penyetoran->harga_per_satuan, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="p-4 mt-6 border border-indigo-200 rounded-lg bg-indigo-50">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-gray-700">Total Nilai</span>
                                <span class="text-2xl font-bold text-indigo-600">
                                    Rp {{ number_format($penyetoran->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($penyetoran->keterangan)
                    <div class="mt-8">
                        <h3 class="pb-2 mb-4 text-lg font-semibold text-gray-900 border-b">
                            Keterangan
                        </h3>
                        <p class="text-base text-gray-700">{{ $penyetoran->keterangan }}</p>
                    </div>
                    @endif

                    <div class="pt-6 mt-8 border-t border-gray-200">
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Dibuat: {{ $penyetoran->created_at->format('d M Y H:i') }}</span>
                            <span>Diupdate: {{ $penyetoran->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mt-6 space-x-3">
                <form action="{{ route('bank-sampah.penyetoran.destroy', $penyetoran) }}" 
                      method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-red-600 border border-transparent rounded-md hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>