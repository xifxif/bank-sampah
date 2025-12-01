<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                
                <!-- Laporan Harian -->
                <div class="overflow-hidden transition-shadow duration-300 bg-white shadow-xl sm:rounded-lg hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Laporan Harian</h3>
                            </div>
                        </div>
                        <p class="mb-4 text-sm text-gray-600">
                            Laporan transaksi penyetoran dan penjualan berdasarkan tanggal tertentu
                        </p>
                        
                        <form action="{{ route('bank-sampah.laporan.harian') }}" method="GET" class="space-y-3">
                            <div>
                                <label for="tanggal_harian" class="block mb-1 text-sm font-medium text-gray-700">
                                    Pilih Tanggal
                                </label>
                                <input type="date" 
                                       id="tanggal_harian" 
                                       name="tanggal" 
                                       value="{{ date('Y-m-d') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center flex-1 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Lihat Laporan
                                </button>
                                <button type="submit" 
                                        name="download" 
                                        value="1"
                                        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Laporan Periode -->
                <div class="overflow-hidden transition-shadow duration-300 bg-white shadow-xl sm:rounded-lg hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 p-3 bg-purple-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Laporan Periode</h3>
                            </div>
                        </div>
                        <p class="mb-4 text-sm text-gray-600">
                            Laporan transaksi dalam rentang tanggal tertentu
                        </p>
                        
                        <form action="{{ route('bank-sampah.laporan.periode') }}" method="GET" class="space-y-3">
                            <div>
                                <label for="tanggal_dari_periode" class="block mb-1 text-sm font-medium text-gray-700">
                                    Dari Tanggal
                                </label>
                                <input type="date" 
                                       id="tanggal_dari_periode" 
                                       name="tanggal_dari" 
                                       value="{{ date('Y-m-01') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>
                            <div>
                                <label for="tanggal_sampai_periode" class="block mb-1 text-sm font-medium text-gray-700">
                                    Sampai Tanggal
                                </label>
                                <input type="date" 
                                       id="tanggal_sampai_periode" 
                                       name="tanggal_sampai" 
                                       value="{{ date('Y-m-d') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center flex-1 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-purple-600 border border-transparent rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                    Lihat Laporan
                                </button>
                                <button type="submit" 
                                        name="download" 
                                        value="1"
                                        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Laporan Bulanan -->
                <div class="overflow-hidden transition-shadow duration-300 bg-white shadow-xl sm:rounded-lg hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 p-3 bg-green-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Laporan Bulanan</h3>
                            </div>
                        </div>
                        <p class="mb-4 text-sm text-gray-600">
                            Laporan transaksi per bulan dengan detail per jenis sampah
                        </p>
                        
                        <form action="{{ route('bank-sampah.laporan.bulanan') }}" method="GET" class="space-y-3">
                            <div>
                                <label for="bulan" class="block mb-1 text-sm font-medium text-gray-700">
                                    Bulan
                                </label>
                                <select id="bulan" 
                                        name="bulan" 
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tahun_bulanan" class="block mb-1 text-sm font-medium text-gray-700">
                                    Tahun
                                </label>
                                <select id="tahun_bulanan" 
                                        name="tahun" 
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center flex-1 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Lihat Laporan
                                </button>
                                <button type="submit" 
                                        name="download" 
                                        value="1"
                                        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Laporan Tahunan -->
                <div class="overflow-hidden transition-shadow duration-300 bg-white shadow-xl sm:rounded-lg hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 p-3 bg-red-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Laporan Tahunan</h3>
                            </div>
                        </div>
                        <p class="mb-4 text-sm text-gray-600">
                            Laporan transaksi per tahun dengan breakdown per bulan
                        </p>
                        
                        <form action="{{ route('bank-sampah.laporan.tahunan') }}" method="GET" class="space-y-3">
                            <div>
                                <label for="tahun_tahunan" class="block mb-1 text-sm font-medium text-gray-700">
                                    Tahun
                                </label>
                                <select id="tahun_tahunan" 
                                        name="tahun" 
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center flex-1 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Lihat Laporan
                                </button>
                                <button type="submit" 
                                        name="download" 
                                        value="1"
                                        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Laporan Per Jenis Sampah -->
                <div class="overflow-hidden transition-shadow duration-300 bg-white shadow-xl sm:rounded-lg hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 p-3 bg-yellow-500 rounded-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Laporan Jenis Sampah</h3>
                            </div>
                        </div>
                        <p class="mb-4 text-sm text-gray-600">
                            Laporan rekap per jenis sampah dalam periode tertentu
                        </p>
                        
                        <form action="{{ route('bank-sampah.laporan.jenis-sampah') }}" method="GET" class="space-y-3">
                            <div>
                                <label for="tanggal_dari_jenis" class="block mb-1 text-sm font-medium text-gray-700">
                                    Dari Tanggal
                                </label>
                                <input type="date" 
                                       id="tanggal_dari_jenis" 
                                       name="tanggal_dari" 
                                       value="{{ date('Y-m-01') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>
                            <div>
                                <label for="tanggal_sampai_jenis" class="block mb-1 text-sm font-medium text-gray-700">
                                    Sampai Tanggal
                                </label>
                                <input type="date" 
                                       id="tanggal_sampai_jenis" 
                                       name="tanggal_sampai" 
                                       value="{{ date('Y-m-d') }}"
                                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center flex-1 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                    Lihat Laporan
                                </button>
                                <button type="submit" 
                                        name="download" 
                                        value="1"
                                        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>