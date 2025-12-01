<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Harga Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('bank-sampah.harga.update', $harga) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="jenis_sampah_id" class="block mb-2 text-sm font-medium text-gray-700">
                                Jenis Sampah <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_sampah_id" 
                                    name="jenis_sampah_id" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('jenis_sampah_id') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Jenis Sampah</option>
                                @foreach($jenisSampah as $jenis)
                                    <option value="{{ $jenis->id }}" 
                                            {{ old('jenis_sampah_id', $harga->jenis_sampah_id) == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }} ({{ $jenis->satuan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_sampah_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="harga" class="block mb-2 text-sm font-medium text-gray-700">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="harga" 
                                   name="harga" 
                                   step="0.01"
                                   value="{{ old('harga', $harga->harga) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('harga') border-red-500 @enderror"
                                   required>
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="tanggal_berlaku" class="block mb-2 text-sm font-medium text-gray-700">
                                Tanggal Berlaku <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   id="tanggal_berlaku" 
                                   name="tanggal_berlaku" 
                                   value="{{ old('tanggal_berlaku', $harga->tanggal_berlaku->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('tanggal_berlaku') border-red-500 @enderror"
                                   required>
                            @error('tanggal_berlaku')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea id="keterangan" 
                                      name="keterangan" 
                                      rows="3"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $harga->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('bank-sampah.harga.index') }}" 
                               class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>