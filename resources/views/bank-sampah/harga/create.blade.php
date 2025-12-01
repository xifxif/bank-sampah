<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tetapkan Harga Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <!-- Info Banner -->
                    <div class="p-4 mb-6 border-l-4 border-blue-400 bg-blue-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Harga yang Anda tetapkan akan digunakan secara otomatis saat input transaksi penyetoran. 
                                    Rekomendasi harga dari DLH ditampilkan sebagai panduan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('bank-sampah.harga.store') }}" method="POST">
                        @csrf

                        <!-- Pilih Jenis Sampah -->
                        <div class="mb-6">
                            <label for="jenis_sampah_id" class="block mb-2 text-sm font-medium text-gray-700">
                                Pilih Jenis Sampah <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_sampah_id" id="jenis_sampah_id" required onchange="showHargaInfo()"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('jenis_sampah_id') border-red-500 @enderror">
                                <option value="">Pilih Jenis Sampah</option>
                                @foreach($jenisSampah as $jenis)
                                    <option value="{{ $jenis->id }}" 
                                        data-harga-standar="{{ $jenis->harga_standar }}"
                                        data-satuan="{{ $jenis->satuan }}"
                                        data-kategori="{{ $jenis->kategori }}"
                                        data-harga-current="{{ $jenis->hargaSampahBank->first()?->harga ?? 0 }}"
                                        {{ old('jenis_sampah_id') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }} - {{ ucfirst($jenis->kategori) }}
                                        @if($jenis->hargaSampahBank->first())
                                            (Sudah ada harga: Rp {{ number_format($jenis->hargaSampahBank->first()->harga, 0, ',', '.') }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_sampah_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info Harga Rekomendasi (Hidden by default) -->
                        <div id="harga-info" style="display: none;" class="p-4 mb-6 border border-gray-200 rounded-lg bg-gray-50">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <p class="mb-1 text-sm text-gray-600">Harga Standar DLH</p>
                                    <p id="harga-standar-display" class="text-2xl font-bold text-green-600">-</p>
                                    <p class="text-xs text-gray-500">Rekomendasi dari DLH</p>
                                </div>
                                <div id="harga-current-section" style="display: none;">
                                    <p class="mb-1 text-sm text-gray-600">Harga Bank Saat Ini</p>
                                    <p id="harga-current-display" class="text-2xl font-bold text-blue-600">-</p>
                                    <p class="text-xs text-gray-500">Harga yang sedang berlaku</p>
                                </div>
                            </div>
                            
                            <!-- Quick Action Buttons -->
                            <div class="flex flex-wrap gap-2 mt-4">
                                <button type="button" onclick="useHargaStandar()" class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded hover:bg-green-200">
                                    Gunakan Harga Standar DLH
                                </button>
                                <button type="button" onclick="useHargaPlus10()" class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                    Standar + 10%
                                </button>
                                <button type="button" onclick="useHargaMinus10()" class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded hover:bg-yellow-200">
                                    Standar - 10%
                                </button>
                            </div>
                        </div>

                        <!-- Input Harga -->
                        <div class="mb-6">
                            <label for="harga" class="block mb-2 text-sm font-medium text-gray-700">
                                Harga Bank Sampah (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="harga" id="harga" 
                                value="{{ old('harga') }}" 
                                min="0" step="1" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg @error('harga') border-red-500 @enderror"
                                oninput="calculateDifference()">
                            @error('harga')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            
                            <!-- Difference Display -->
                            <div id="difference" class="mt-2 text-sm"></div>
                        </div>

                        <!-- Tanggal Berlaku -->
                        <div class="mb-6">
                            <label for="tanggal_berlaku" class="block mb-2 text-sm font-medium text-gray-700">
                                Tanggal Berlaku <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_berlaku" id="tanggal_berlaku" 
                                value="{{ old('tanggal_berlaku', date('Y-m-d')) }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Alasan penetapan harga...">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('bank-sampah.harga.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Simpan Harga
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let hargaStandar = 0;
        let hargaCurrent = 0;
        
        function showHargaInfo() {
            const select = document.getElementById('jenis_sampah_id');
            const selectedOption = select.options[select.selectedIndex];
            
            if (select.value) {
                hargaStandar = parseFloat(selectedOption.getAttribute('data-harga-standar')) || 0;
                hargaCurrent = parseFloat(selectedOption.getAttribute('data-harga-current')) || 0;
                const satuan = selectedOption.getAttribute('data-satuan');
                
                document.getElementById('harga-info').style.display = 'block';
                document.getElementById('harga-standar-display').textContent = 
                    'Rp ' + hargaStandar.toLocaleString('id-ID') + ' / ' + satuan;
                
                // Show current price if exists
                if (hargaCurrent > 0) {
                    document.getElementById('harga-current-section').style.display = 'block';
                    document.getElementById('harga-current-display').textContent = 
                        'Rp ' + hargaCurrent.toLocaleString('id-ID') + ' / ' + satuan;
                } else {
                    document.getElementById('harga-current-section').style.display = 'none';
                }
                
                // Auto-fill with harga standar if no price yet
                if (!document.getElementById('harga').value || document.getElementById('harga').value == 0) {
                    document.getElementById('harga').value = hargaStandar;
                    calculateDifference();
                }
            } else {
                document.getElementById('harga-info').style.display = 'none';
            }
        }
        
        function useHargaStandar() {
            document.getElementById('harga').value = hargaStandar;
            calculateDifference();
        }
        
        function useHargaPlus10() {
            const newPrice = Math.round(hargaStandar * 1.1);
            document.getElementById('harga').value = newPrice;
            calculateDifference();
        }
        
        function useHargaMinus10() {
            const newPrice = Math.round(hargaStandar * 0.9);
            document.getElementById('harga').value = newPrice;
            calculateDifference();
        }
        
        function calculateDifference() {
            const newPrice = parseFloat(document.getElementById('harga').value) || 0;
            const diff = newPrice - hargaStandar;
            const percentage = hargaStandar > 0 ? ((diff / hargaStandar) * 100).toFixed(1) : 0;
            const diffElement = document.getElementById('difference');
            
            if (diff > 0) {
                diffElement.innerHTML = `<span class="font-semibold text-green-600">↑ Lebih tinggi Rp ${Math.abs(diff).toLocaleString('id-ID')} (${percentage}%) dari standar DLH</span>`;
            } else if (diff < 0) {
                diffElement.innerHTML = `<span class="font-semibold text-red-600">↓ Lebih rendah Rp ${Math.abs(diff).toLocaleString('id-ID')} (${percentage}%) dari standar DLH</span>`;
            } else {
                diffElement.innerHTML = '<span class="font-semibold text-green-600">✓ Sesuai dengan harga standar DLH</span>';
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            showHargaInfo();
        });
    </script>
    @endpush
</x-app-layout>