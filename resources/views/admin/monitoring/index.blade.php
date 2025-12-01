<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Monitoring') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Quick Links -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('admin.monitoring.harga') }}" class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 hover:scale-105">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Monitoring Harga</h3>
                            <p class="text-sm opacity-90">Bandingkan harga bank</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.monitoring.transaksi') }}" class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 hover:scale-105">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Monitoring Transaksi</h3>
                            <p class="text-sm opacity-90">Per bank sampah</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.monitoring.wilayah') }}" class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 hover:scale-105">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Monitoring Wilayah</h3>
                            <p class="text-sm opacity-90">Kinerja per wilayah</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.monitoring.log') }}" class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Log Aktivitas</h3>
                            <p class="text-sm opacity-90">Riwayat aktivitas user</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Tentang Monitoring</h3>
                    <p class="text-gray-600">
                        Dashboard monitoring membantu Anda memantau kinerja seluruh bank sampah, 
                        membandingkan harga, dan menganalisis aktivitas sistem secara real-time.
                    </p>
                </div>

                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Fitur Utama</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Perbandingan harga antar bank
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Tracking transaksi real-time
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Analisis per wilayah
                        </li>
                    </ul>
                </div>

                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Tips Monitoring</h3>
                    <p class="text-gray-600">
                        Gunakan filter tanggal dan wilayah untuk analisis yang lebih spesifik. 
                        Periksa log aktivitas secara berkala untuk memastikan tidak ada aktivitas mencurigakan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>