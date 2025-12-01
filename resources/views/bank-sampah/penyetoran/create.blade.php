<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Input Transaksi Penyetoran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <form action="{{ route('bank-sampah.penyetoran.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Tanggal Setor -->
                            <div>
                                <label for="tanggal_setor" class="block mb-2 text-sm font-medium text-gray-700">
                                    Tanggal Setor <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_setor" id="tanggal_setor" 
                                    value="{{ old('tanggal_setor', date('Y-m-d')) }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('tanggal_setor') border-red-500 @enderror">
                                @error('tanggal_setor')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Penyetor -->
                            <div>
                                <label for="nama_penyetor" class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Penyetor <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_penyetor" id="nama_penyetor" 
                                    value="{{ old('nama_penyetor') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_penyetor') border-red-500 @enderror"
                                    placeholder="Nama lengkap penyetor">
                                @error('nama_penyetor')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No Identitas -->
                            <div>
                                <label for="no_identitas" class="block mb-2 text-sm font-medium text-gray-700">
                                    No. Identitas / No. Anggota
                                </label>
                                <input type="text" name="no_identitas" id="no_identitas" 
                                    value="{{ old('no_identitas') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="NIK / No. Anggota">
                            </div>

                            <!-- Jenis Sampah -->
                            <div>
                                <label for="jenis_sampah_id" class="block mb-2 text-sm font-medium text-gray-700">
                                    Jenis Sampah <span class="text-red-500">*</span>
                                </label>
                                <select name="jenis_sampah_id" id="jenis_sampah_id" required onchange="loadHarga()"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('jenis_sampah_id') border-red-500 @enderror">
                                    <option value="">Pilih Jenis Sampah</option>
                                    @foreach($jenisSampah as $jenis)
                                        <option value="{{ $jenis->id }}" {{ old('jenis_sampah_id') == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis }} ({{ $jenis->satuan }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_sampah_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Info Harga (Auto-loaded) -->
                        <div id="harga-info" style="display: none;" class="p-4 mt-6 border-l-4 border-blue-400 bg-blue-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 ml-3">
                                    <p id="harga-source-text" class="text-sm text-blue-700"></p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-3">
                            <!-- Berat -->
                            <div>
                                <label for="berat" class="block mb-2 text-sm font-medium text-gray-700">
                                    Berat <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="berat" id="berat" 
                                        value="{{ old('berat') }}" 
                                        min="0.01" step="0.01" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('berat') border-red-500 @enderror"
                                        placeholder="0.00"
                                        oninput="calculateSubtotal()">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span id="satuan-display" class="text-gray-500 sm:text-sm">kg</span>
                                    </div>
                                </div>
                                @error('berat')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Per Satuan -->
                            <div>
                                <label for="harga_per_satuan" class="block mb-2 text-sm font-medium text-gray-700">
                                    Harga Per Satuan (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="harga_per_satuan" id="harga_per_satuan" 
                                    value="{{ old('harga_per_satuan') }}" 
                                    min="0" step="1" required readonly
                                    class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('harga_per_satuan') border-red-500 @enderror"
                                    placeholder="0">
                                @error('harga_per_satuan')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">
                                    <button type="button" onclick="enableEditHarga()" class="text-blue-600 hover:text-blue-800">
                                        Klik untuk ubah harga manual
                                    </button>
                                </p>
                            </div>

                            <!-- Subtotal -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Subtotal (Rp)
                                </label>
                                <input type="text" id="subtotal_display" readonly
                                    class="w-full text-lg font-bold text-green-600 bg-gray-100 border-gray-300 rounded-md"
                                    value="Rp 0">
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mt-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('bank-sampah.penyetoran.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentSatuan = 'kg';
        
        async function loadHarga() {
            const jenisSampahId = document.getElementById('jenis_sampah_id').value;
            
            if (!jenisSampahId) {
                document.getElementById('harga-info').style.display = 'none';
                document.getElementById('harga_per_satuan').value = '';
                return;
            }
            
            try {
                const response = await fetch(`/bank-sampah/penyetoran/harga/${jenisSampahId}`);
                const data = await response.json();
                
                // Update satuan
                currentSatuan = data.satuan;
                document.getElementById('satuan-display').textContent = data.satuan;
                
                // Update harga
                document.getElementById('harga_per_satuan').value = data.harga;
                
                // Show info
                document.getElementById('harga-info').style.display = 'block';
                
                const infoText = document.getElementById('harga-source-text');
                if (data.source === 'bank') {
                    infoText.innerHTML = `✓ Menggunakan harga bank: <strong>Rp ${data.harga.toLocaleString('id-ID')}/${data.satuan}</strong> (sesuai yang sudah Anda tetapkan)`;
                } else {
                    infoText.innerHTML = `⚠️ Menggunakan harga standar DLH: <strong>Rp ${data.harga.toLocaleString('id-ID')}/${data.satuan}</strong><br>
                        <span class="text-xs">Anda belum menetapkan harga untuk jenis sampah ini. <a href="{{ route('bank-sampah.harga.create') }}" class="underline">Tetapkan sekarang</a></span>`;
                }
                
                calculateSubtotal();
            } catch (error) {
                console.error('Error loading harga:', error);
                alert('Gagal memuat harga. Silakan coba lagi.');
            }
        }
        
        function calculateSubtotal() {
            const berat = parseFloat(document.getElementById('berat').value) || 0;
            const harga = parseFloat(document.getElementById('harga_per_satuan').value) || 0;
            const subtotal = berat * harga;
            
            document.getElementById('subtotal_display').value = 'Rp ' + subtotal.toLocaleString('id-ID');
        }
        
        function enableEditHarga() {
            const hargaInput = document.getElementById('harga_per_satuan');
            hargaInput.readOnly = false;
            hargaInput.classList.remove('bg-gray-50');
            hargaInput.classList.add('bg-white');
            hargaInput.focus();
            hargaInput.oninput = calculateSubtotal;
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSampahSelect = document.getElementById('jenis_sampah_id');
            if (jenisSampahSelect.value) {
                loadHarga();
            }
        });
    </script>
    @endpush
</x-app-layout>