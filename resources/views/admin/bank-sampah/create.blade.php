<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Bank Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <form action="{{ route('admin.bank-sampah.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Kode Bank -->
                            <div>
                                <label for="kode_bank" class="block mb-2 text-sm font-medium text-gray-700">
                                    Kode Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kode_bank" id="kode_bank" value="{{ old('kode_bank') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kode_bank') border-red-500 @enderror">
                                @error('kode_bank')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Bank -->
                            <div>
                                <label for="nama_bank" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_bank" id="nama_bank" value="{{ old('nama_bank') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_bank') border-red-500 @enderror">
                                @error('nama_bank')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Wilayah -->
                            <div>
                                <label for="wilayah_id" class="block mb-2 text-sm font-medium text-gray-700">
                                    Wilayah <span class="text-red-500">*</span>
                                </label>
                                <select name="wilayah_id" id="wilayah_id" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('wilayah_id') border-red-500 @enderror">
                                    <option value="">Pilih Wilayah</option>
                                    @foreach($wilayah as $w)
                                        <option value="{{ $w->id }}" {{ old('wilayah_id') == $w->id ? 'selected' : '' }}>
                                            {{ $w->nama_wilayah }} ({{ ucfirst($w->jenis) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('wilayah_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Pengelola -->
                            <div>
                                <label for="nama_pengelola" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Pengelola <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_pengelola" id="nama_pengelola" value="{{ old('nama_pengelola') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_pengelola') border-red-500 @enderror">
                                @error('nama_pengelola')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div>
                                <label for="no_telepon" class="block mb-2 text-sm font-medium text-gray-700">
                                    No. Telepon
                                </label>
                                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Tanggal Berdiri -->
                            <div>
                                <label for="tanggal_berdiri" class="block mb-2 text-sm font-medium text-gray-700">
                                    Tanggal Berdiri
                                </label>
                                <input type="date" name="tanggal_berdiri" id="tanggal_berdiri" value="{{ old('tanggal_berdiri') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status" required
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mt-6">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-700">
                                Alamat <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" id="alamat" rows="3" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mt-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('admin.bank-sampah.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
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