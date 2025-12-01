<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Transaksi Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('bank-sampah.penjualan.update', $penjualan) }}" method="POST" id="formPenjualan">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                No. Transaksi
                            </label>
                            <div class="block w-full px-3 py-2 mt-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50">
                                {{ $penjualan->no_transaksi }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="tanggal_jual" class="block mb-2 text-sm font-medium text-gray-700">
                                Tanggal Jual <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_jual" name="tanggal_jual" 
                                   value="{{ old('tanggal_jual', $penjualan->tanggal_jual->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('tanggal_jual') border-red-500 @enderror"
                                   required>
                            @error('tanggal_jual')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="pembeli" class="block mb-2 text-sm font-medium text-gray-700">
                                Nama Pembeli <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="pembeli" name="pembeli" 
                                   value="{{ old('pembeli', $penjualan->pembeli) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('pembeli') border-red-500 @enderror"
                                   required>
                            @error('pembeli')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="no_telepon_pembeli" class="block mb-2 text-sm font-medium text-gray-700">
                                No. Telepon Pembeli
                            </label>
                            <input type="text" id="no_telepon_pembeli" name="no_telepon_pembeli" 
                                   value="{{ old('no_telepon_pembeli', $penjualan->no_telepon_pembeli) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('no_telepon_pembeli') border-red-500 @enderror">
                            @error('no_telepon_pembeli')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="jenis_sampah_id" class="block mb-2 text-sm font-medium text-gray-700">
                                Jenis Sampah <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_sampah_id" name="jenis_sampah_id" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('jenis_sampah_id') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Jenis Sampah</option>
                                @foreach($jenisSampah as $jenis)
                                    <option value="{{ $jenis->id }}" 
                                            data-satuan="{{ $jenis->satuan }}"
                                            {{ old('jenis_sampah_id', $penjualan->jenis_sampah_id) == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }} ({{ $jenis->satuan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_sampah_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="berat" class="block mb-2 text-sm font-medium text-gray-700">
                                Berat <span class="text-red-500">*</span>
                            </label>
                            <div class="flex">
                                <input type="number" id="berat" name="berat" step="0.01" 
                                       value="{{ old('berat', $penjualan->berat) }}"
                                       class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-l-md shadow-sm @error('berat') border-red-500 @enderror"
                                       required>
                                <span id="satuan_display" class="inline-flex items-center px-3 text-sm text-gray-500 border border-l-0 border-gray-300 bg-gray-50 rounded-r-md">
                                    {{ $penjualan->jenisSampah->satuan }}
                                </span>
                            </div>
                            @error('berat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="harga_jual_per_satuan" class="block mb-2 text-sm font-medium text-gray-700">
                                Harga Jual per Satuan (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="harga_jual_per_satuan" name="harga_jual_per_satuan" 
                                   step="0.01" value="{{ old('harga_jual_per_satuan', $penjualan->harga_jual_per_satuan) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('harga_jual_per_satuan') border-red-500 @enderror"
                                   required>
                            @error('harga_jual_per_satuan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Total</label>
                            <div class="block w-full px-3 py-2 mt-1 font-semibold text-gray-900 border border-gray-300 rounded-md bg-gray-50">
                                Rp <span id="total_display">{{ number_format($penjualan->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="3"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $penjualan->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('bank-sampah.penjualan.index') }}" 
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSampahSelect = document.getElementById('jenis_sampah_id');
            const beratInput = document.getElementById('berat');
            const hargaInput = document.getElementById('harga_jual_per_satuan');
            const satuanDisplay = document.getElementById('satuan_display');
            const totalDisplay = document.getElementById('total_display');

            jenisSampahSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const satuan = selectedOption.dataset.satuan || '-';
                satuanDisplay.textContent = satuan;
            });

            function calculateTotal() {
                const berat = parseFloat(beratInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                const total = berat * harga;
                totalDisplay.textContent = total.toLocaleString('id-ID');
            }

            beratInput.addEventListener('input', calculateTotal);
            hargaInput.addEventListener('input', calculateTotal);
        });
    </script>
    @endpush
</x-app-layout>