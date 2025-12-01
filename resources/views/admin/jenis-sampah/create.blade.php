<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jenis Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <form action="{{ route('admin.jenis-sampah.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Kode Jenis -->
                            <div>
                                <label for="kode_jenis" class="block mb-2 text-sm font-medium text-gray-700">
                                    Kode Jenis <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kode_jenis" id="kode_jenis" value="{{ old('kode_jenis') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kode_jenis') border-red-500 @enderror"
                                    placeholder="PLT-001">
                                @error('kode_jenis')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Jenis -->
                            <div>
                                <label for="nama_jenis" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Jenis <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_jenis" id="nama_jenis" value="{{ old('nama_jenis') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_jenis') border-red-500 @enderror"
                                    placeholder="Plastik PET">
                                @error('nama_jenis')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-700">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="kategori" id="kategori" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kategori') border-red-500 @enderror">
                                    <option value="">Pilih Kategori</option>
                                    <option value="organik" {{ old('kategori') == 'organik' ? 'selected' : '' }}>Organik</option>
                                    <option value="anorganik" {{ old('kategori', 'anorganik') == 'anorganik' ? 'selected' : '' }}>Anorganik</option>
                                    <option value="b3" {{ old('kategori') == 'b3' ? 'selected' : '' }}>B3 (Bahan Berbahaya & Beracun)</option>
                                </select>
                                @error('kategori')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Satuan -->
                            <div>
                                <label for="satuan" class="block mb-2 text-sm font-medium text-gray-700">
                                    Satuan <span class="text-red-500">*</span>
                                </label>
                                <select name="satuan" id="satuan" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('satuan') border-red-500 @enderror">
                                    <option value="kg" {{ old('satuan', 'kg') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                    <option value="unit" {{ old('satuan') == 'unit' ? 'selected' : '' }}>Unit</option>
                                </select>
                                @error('satuan')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Standar -->
                            <div>
                                <label for="harga_standar" class="block mb-2 text-sm font-medium text-gray-700">
                                    Harga Standar (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="harga_standar" id="harga_standar" value="{{ old('harga_standar', 0) }}" min="0" step="0.01" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('harga_standar') border-red-500 @enderror"
                                    placeholder="3000">
                                @error('harga_standar')
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
                                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mt-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Deskripsi jenis sampah...">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('admin.jenis-sampah.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>