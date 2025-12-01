<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Filter Periode Laporan</h3>
                    <form id="filterForm" class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label for="tanggal_dari" class="block text-sm font-medium text-gray-700">Tanggal Dari</label>
                            <input type="date" 
                                   id="tanggal_dari" 
                                   name="tanggal_dari" 
                                   value="{{ date('Y-m-01') }}"
                                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="tanggal_sampai" class="block text-sm font-medium text-gray-700">Tanggal Sampai</label>
                            <input type="date" 
                                   id="tanggal_sampai" 
                                   name="tanggal_sampai" 
                                   value="{{ date('Y-m-d') }}"
                                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Laporan Cards -->
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <!-- Laporan Transaksi -->
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Laporan Transaksi</h3>
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="mb-4 text-gray-600">Laporan detail transaksi penyetoran dan penjualan sampah</p>
                            <button onclick="openLaporan('{{ route('admin.laporan.transaksi') }}')"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25">
                                Lihat Laporan
                            </button>
                        </div>

                        <!-- Laporan Jenis Sampah -->
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Laporan Jenis Sampah</h3>
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <p class="mb-4 text-gray-600">Analisis performa berdasarkan jenis sampah</p>
                            <button onclick="openLaporan('{{ route('admin.laporan.jenis-sampah') }}')"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring focus:ring-green-300 disabled:opacity-25">
                                Lihat Laporan
                            </button>
                        </div>

                        <!-- Laporan Per Bank Sampah -->
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Laporan Per Bank Sampah</h3>
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <p class="mb-4 text-gray-600">Performa masing-masing bank sampah</p>
                            <button onclick="openLaporan('{{ route('admin.laporan.per-bank') }}')"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-purple-600 border border-transparent rounded-md hover:bg-purple-700 active:bg-purple-800 focus:outline-none focus:border-purple-800 focus:ring focus:ring-purple-300 disabled:opacity-25">
                                Lihat Laporan
                            </button>
                        </div>

                        <!-- Laporan Per Wilayah -->
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Laporan Per Wilayah</h3>
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                            <p class="mb-4 text-gray-600">Analisis berdasarkan wilayah kerja</p>
                            <button onclick="openLaporan('{{ route('admin.laporan.per-wilayah') }}')"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-orange-600 border border-transparent rounded-md hover:bg-orange-700 active:bg-orange-800 focus:outline-none focus:border-orange-800 focus:ring focus:ring-orange-300 disabled:opacity-25">
                                Lihat Laporan
                            </button>
                        </div>

                        <!-- Laporan Nilai Ekonomis -->
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Laporan Nilai Ekonomis</h3>
                                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="mb-4 text-gray-600">Analisis nilai ekonomis sampah per kategori</p>
                            <button onclick="openLaporan('{{ route('admin.laporan.nilai-ekonomis') }}')"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-800 focus:ring focus:ring-yellow-300 disabled:opacity-25">
                                Lihat Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openLaporan(url) {
            const tanggalDari = document.getElementById('tanggal_dari').value;
            const tanggalSampai = document.getElementById('tanggal_sampai').value;
            
            if (!tanggalDari || !tanggalSampai) {
                alert('Mohon pilih tanggal terlebih dahulu');
                return;
            }
            
            // Build URL with query parameters
            const params = new URLSearchParams({
                tanggal_dari: tanggalDari,
                tanggal_sampai: tanggalSampai
            });
            
            window.location.href = `${url}?${params.toString()}`;
        }
    </script>
</x-app-layout>