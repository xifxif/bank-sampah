<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Harga Standar') }} - {{ $jenisSampah->nama_jenis }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <x-alert />

                    <!-- Info Jenis Sampah -->
                    <div class="p-4 mb-6 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Kode Jenis</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $jenisSampah->kode_jenis }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kategori</p>
                                <p class="text-lg font-semibold text-gray-900">{{ ucfirst($jenisSampah->kategori) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Satuan</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $jenisSampah->satuan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Harga Saat Ini</p>
                                <p class="text-lg font-bold text-green-600">Rp {{ number_format($jenisSampah->harga_standar, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.harga-standar.update', $jenisSampah) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Harga Standar Baru -->
                        <div class="mb-6">
                            <label for="harga_standar" class="block mb-2 text-sm font-medium text-gray-700">
                                Harga Standar Baru (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="harga_standar" id="harga_standar" 
                                value="{{ old('harga_standar', $jenisSampah->harga_standar) }}" 
                                min="0" step="0.01" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg @error('harga_standar') border-red-500 @enderror"
                                oninput="calculateDifference()">
                            @error('harga_standar')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            
                            <!-- Difference Display -->
                            <div id="difference" class="mt-2 text-sm"></div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">
                                Keterangan Perubahan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Alasan perubahan harga...">{{ old('keterangan', $jenisSampah->keterangan) }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.harga-standar.index') }}" class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Update Harga
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const oldPrice = {{ $jenisSampah->harga_standar }};
        
        function calculateDifference() {
            const newPrice = parseFloat(document.getElementById('harga_standar').value) || 0;
            const diff = newPrice - oldPrice;
            const percentage = oldPrice > 0 ? ((diff / oldPrice) * 100).toFixed(2) : 0;
            const diffElement = document.getElementById('difference');
            
            if (diff > 0) {
                diffElement.innerHTML = `<span class="font-semibold text-green-600">↑ Naik Rp ${diff.toLocaleString('id-ID')} (${percentage}%)</span>`;
            } else if (diff < 0) {
                diffElement.innerHTML = `<span class="font-semibold text-red-600">↓ Turun Rp ${Math.abs(diff).toLocaleString('id-ID')} (${percentage}%)</span>`;
            } else {
                diffElement.innerHTML = '<span class="text-gray-500">Tidak ada perubahan</span>';
            }
        }
        
        // Calculate on page load
        calculateDifference();
    </script>
    @endpush
</x-app-layout>