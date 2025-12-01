<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Wilayah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <form action="{{ route('admin.wilayah.update', $wilayah) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Kode Wilayah -->
                            <div>
                                <label for="kode_wilayah" class="block mb-2 text-sm font-medium text-gray-700">
                                    Kode Wilayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kode_wilayah" id="kode_wilayah" value="{{ old('kode_wilayah', $wilayah->kode_wilayah) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kode_wilayah') border-red-500 @enderror">
                                @error('kode_wilayah')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Wilayah -->
                            <div>
                                <label for="nama_wilayah" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Wilayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_wilayah" id="nama_wilayah" value="{{ old('nama_wilayah', $wilayah->nama_wilayah) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_wilayah') border-red-500 @enderror">
                                @error('nama_wilayah')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis -->
                            <div>
                                <label for="jenis" class="block mb-2 text-sm font-medium text-gray-700">
                                    Jenis <span class="text-red-500">*</span>
                                </label>
                                <select name="jenis" id="jenis" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('jenis') border-red-500 @enderror">
                                    <option value="">Pilih Jenis</option>
                                    <option value="kecamatan" {{ old('jenis', $wilayah->jenis) == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="kelurahan" {{ old('jenis', $wilayah->jenis) == 'kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                                    <option value="desa" {{ old('jenis', $wilayah->jenis) == 'desa' ? 'selected' : '' }}>Desa</option>
                                </select>
                                @error('jenis')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="is_active" class="block mb-2 text-sm font-medium text-gray-700">
                                    Status
                                </label>
                                <select name="is_active" id="is_active"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="1" {{ old('is_active', $wilayah->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', $wilayah->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mt-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $wilayah->keterangan) }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('admin.wilayah.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>