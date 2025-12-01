<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah DLH - Informasi Harga & Layanan</title>

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Poppins', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI',
                            'sans-serif'],
                    },
                    colors: {
                        'green': {
                            DEFAULT: '#047857',
                            'dark': '#065f46',
                            '50': '#ecfdf5',
                            '100': '#d1fae5',
                        },
                        'text': {
                            'main': '#0f172a',
                            'muted': '#6b7280',
                        },
                        'bg-soft': '#f4f9f6',
                    },
                    boxShadow: {
                        'soft': '0 18px 40px rgba(15, 23, 42, 0.08)',
                        'medium': '0 18px 40px rgba(15, 23, 42, 0.12)',
                        'large': '0 12px 30px rgba(0, 0, 0, 0.4)',
                    },
                    spacing: {
                        '4.5': '1.125rem',
                        '6.5': '1.625rem',
                        '7': '1.75rem',
                    }
                }
            }
        }
    </script>

    <!-- CSS AOS (Animasi Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        .brand-logo {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 20%, #bbf7d0, #16a34a);
        }

        .hero-leafy {
            background: url("../images/hero.jpeg") center/cover no-repeat;
        }

        .hero-wave-bottom svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        .news-thumb {
            border-radius: 16px;
            background-size: cover;
            background-position: center;
        }

        .thumb-1 {
            background-image: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .thumb-3 {
            background-image: linear-gradient(135deg, #a855f7, #6366f1);
        }

        .leaf-strip {
            background: url("../images/footer.jpeg") center/cover no-repeat;
        }

        /* Custom scrollbar untuk tabel harga */
        .price-table-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .price-table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .price-table-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .price-table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Badge kategori */
        .badge-plastik {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-kertas {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-logam {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .badge-kaca {
            background-color: #ddd6fe;
            color: #5b21b6;
        }

        .badge-elektronik {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-organik {
            background-color: #d1fae5;
            color: #065f46;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white text-text-main">

    <!-- Header -->
    <header
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out topbar bg-gradient-to-b from-slate-900/45 to-transparent text-gray-50">
        <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3.5">
                <!-- Brand Logo -->
                <div class="flex items-center space-x-2.5" data-aos="fade-right">
                    <span class="brand-logo"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-xs font-medium tracking-wider uppercase opacity-80">DINAS LINGKUNGAN
                            HIDUP</span>
                        <span class="text-sm font-semibold">Bank Sampah Kota</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex items-center space-x-4 text-sm" data-aos="fade-left">
                    <a href="#beranda"
                        class="pb-1 font-medium text-white transition-colors border-b-2 border-white duration-250">Beranda</a>
                    <a href="{{ route('login') }}"
                        class="bg-white text-slate-900 px-4 py-2 rounded-full text-xs font-medium border border-white/80 transition-all duration-250 hover:bg-green-50 hover:-translate-y-0.5 hover:shadow-lg">Dashboard</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda"
    class="relative flex items-center justify-center p-20 pb-20 mb-0 text-center text-white bg-center bg-no-repeat bg-cover h-96"
    style="background-image: url('https://plus.unsplash.com/premium_photo-1683133531613-6a7db8847c72?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    
        <div class="absolute inset-0 hero-overlay bg-gradient-to-b from-black/22 via-black/15 to-transparent"></div>

        <div class="relative z-10 max-w-2xl px-4 mx-auto mt-14" data-aos="zoom-in">
            <p class="mb-2 text-sm font-medium tracking-widest uppercase opacity-90">GERAKAN KOTA BERSIH SAMPAH</p>
            <h1 class="mb-4 text-3xl font-bold md:text-4xl" style="text-shadow: 0 6px 12px rgba(0,0,0,0.6);">
                Kelola Sampah, Jaga Lingkungan,<br>Tambah Penghasilan
            </h1>

            <p class="max-w-2xl mx-auto mb-6 text-base leading-relaxed" style="text-shadow: 0 4px 8px rgba(0,0,0,0.6);">
                Sistem informasi Bank Sampah yang menyatukan harga...
            </p>

            <div class="flex justify-center space-x-3">
                <a href="#harga"
                    class="bg-white text-green px-6 py-3 rounded-full text-sm font-semibold no-underline transition-all duration-250 hover:bg-green-100 hover:-translate-y-0.5 hover:shadow-large">Lihat
                    Daftar Harga</a>
            </div>
        </div>

        <!-- Wave Bottom -->
        <div class="absolute left-0 right-0 z-10 overflow-hidden leading-none h-36 hero-wave-bottom -bottom-10">
            <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path
                    d="M0,192 C120,224 240,256 360,245 C480,235 600,181 720,170 C840,160 960,192 1080,197 C1200,203 1320,181 1440,170 L1440,320 L0,320 Z"
                    fill="rgba(255,255,255,0.55)" />
                <path
                    d="M0,224 C140,272 280,288 420,272 C560,256 700,208 840,186 C980,165 1120,171 1280,192 C1360,203 1400,211 1440,219 L1440,320 L0,320 Z"
                    fill="#ffffff" />
            </svg>
        </div>
    </section>

    <!-- Main Content -->
    <main class="relative z-20">
        <!-- About Section -->
        <section id="tentang" class="py-12 bg-white md:py-16">
            <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
                <!-- About Card -->
                <div class="p-6 mb-8 bg-white rounded-2xl shadow-soft md:p-8" data-aos="fade-up">
                    <h2 class="mb-2 text-2xl font-bold">Tentang Bank Sampah DLH</h2>
                    <p class="max-w-3xl mb-6 text-text-muted">
                        Program kolaborasi Dinas Lingkungan Hidup dengan Bank Sampah Pusat dan Unit
                        untuk mewujudkan kota yang bersih dan ramah lingkungan.
                    </p>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <!-- Visi -->
                        <div class="p-6 transition-all duration-300 bg-gray-50 rounded-xl hover:-translate-y-2 hover:shadow-medium"
                            data-aos="zoom-in">
                            <div
                                class="flex items-center justify-center w-10 h-10 mb-4 text-lg rounded-full bg-green-50">
                                🌿</div>
                            <h3 class="mb-2 text-lg font-semibold">Visi</h3>
                            <p class="text-sm text-text-muted">
                                Mewujudkan lingkungan kota yang bersih melalui pengelolaan sampah berbasis masyarakat.
                            </p>
                        </div>

                        <!-- Misi -->
                        <div class="p-6 transition-all duration-300 bg-gray-50 rounded-xl hover:-translate-y-2 hover:shadow-medium"
                            data-aos="zoom-in" data-aos-delay="100">
                            <div
                                class="flex items-center justify-center w-10 h-10 mb-4 text-lg rounded-full bg-green-50">
                                ♻️</div>
                            <h3 class="mb-2 text-lg font-semibold">Misi</h3>
                            <p class="text-sm text-text-muted">
                                Menyediakan sistem harga sampah yang terintegrasi antara Bank Sampah Pusat
                                dan Unit, serta edukasi pengelolaan sampah berkelanjutan.
                            </p>
                        </div>

                        <!-- Manfaat -->
                        <div class="p-6 transition-all duration-300 bg-gray-50 rounded-xl hover:-translate-y-2 hover:shadow-medium"
                            data-aos="zoom-in" data-aos-delay="200">
                            <div
                                class="flex items-center justify-center w-10 h-10 mb-4 text-lg rounded-full bg-green-50">
                                🧾</div>
                            <h3 class="mb-2 text-lg font-semibold">Manfaat</h3>
                            <p class="text-sm text-text-muted">
                                Harga sampah yang jelas dan seragam, pencatatan lebih rapi, dan
                                kemudahan akses informasi bagi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- News Section -->
                <section id="berita" class="p-6 mb-8 bg-white rounded-2xl shadow-soft" data-aos="fade-up">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold">Berita & Artikel Terbaru</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- News Item 1 -->
                        <article
                            class="grid grid-cols-1 sm:grid-cols-[100px_1fr] gap-4 p-4 rounded-lg transition-all duration-250 hover:bg-gray-50 hover:-translate-y-1">
                            <div class="h-20 bg-center bg-no-repeat bg-cover rounded-xl"
                                style="background-image: url('https://images.unsplash.com/photo-1604187351574-c75ca79f5807');">
                            </div>
                            <div class="flex flex-col justify-center">
                                <span class="mb-1 text-xs font-medium text-green">Artikel</span>
                                <a href="/artikel/teknologi-plastik">
                                    <h3 class="mb-1 text-base font-semibold">Teknologi Bank Sampah Plastik</h3>
                                </a>
                                <p class="text-xs text-text-muted">Dipublikasikan 21 Nov 2025</p>
                            </div>
                        </article>

                        <!-- News Item 2 -->
                        <article
                            class="grid grid-cols-1 sm:grid-cols-[100px_1fr] gap-4 p-4 rounded-lg transition-all duration-250 hover:bg-gray-50 hover:-translate-y-1">
                            <div class="h-20 bg-center bg-no-repeat bg-cover rounded-xl sm:h-full"
                                style="background-image: url('https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1200&h=600&fit=crop');">
                            </div>

                            <div class="flex flex-col justify-center">
                                <span class="mb-1 text-xs font-medium text-green">Arttikel</span>
                                <a href="/artikel/memilah-sampah">
                                    <h3 class="mb-1 text-base font-semibold">Cara Memilah Sampah di Rumah</h3>
                                </a>
                                <p class="text-xs text-text-muted">Dipublikasikan 15 Nov 2025</p>
                            </div>
                        </article>
                    </div>
                </section>

                <section id="harga" class="p-6 mb-8 bg-white rounded-2xl shadow-soft" data-aos="fade-up">
                    <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:justify-between sm:items-center">
                        <h2 class="text-xl font-bold">Daftar Harga Sampah Bank Sampah Pusat</h2>
                        <span class="px-3 py-1 text-xs font-medium text-blue-700 rounded-full bg-blue-50 w-fit">
                            Harga Berlaku Semua Unit
                        </span>
                    </div>

                    <p class="max-w-3xl mb-6 text-sm text-text-muted">
                        Harga berikut ditetapkan oleh Bank Sampah Pusat dan digunakan secara otomatis
                        oleh seluruh Bank Sampah Unit. Nilai dapat berubah sewaktu-waktu sesuai kebijakan.
                    </p>

                    @if($jenisSampah->count() > 0)
                        <div class="overflow-x-auto border border-gray-200 rounded-lg price-table-wrapper">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            No</th>
                                        <th
                                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Jenis Sampah</th>
                                        <th
                                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Kategori</th>
                                        <th
                                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Satuan</th>
                                        <th
                                            class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                            Harga per Satuan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($jenisSampah as $index => $jenis)
                                        <tr class="transition-colors hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $jenis->nama_jenis }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full badge-{{ strtolower($jenis->kategori) }}">
                                                    {{ ucfirst($jenis->kategori) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ ucfirst($jenis->satuan) }}</td>
                                            <td class="px-4 py-3 text-sm font-semibold text-right text-green">
                                                Rp {{ number_format($jenis->harga_standar, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary Stats -->
                        <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-3">
                            <div class="p-4 text-center bg-gray-50 rounded-xl">
                                <p class="text-2xl font-bold text-green">{{ $jenisSampah->count() }}</p>
                                <p class="text-sm text-text-muted">Jenis Sampah</p>
                            </div>
                            <div class="p-4 text-center bg-gray-50 rounded-xl">
                                <p class="text-2xl font-bold text-green">{{ $jenisSampah->groupBy('kategori')->count() }}</p>
                                <p class="text-sm text-text-muted">Kategori</p>
                            </div>
                            <div class="p-4 text-center bg-gray-50 rounded-xl">
                                <p class="text-2xl font-bold text-green">
                                    Rp {{ number_format($jenisSampah->avg('harga'), 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-text-muted">Harga Rata-rata</p>
                            </div>
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gray-100 rounded-full">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-gray-900">Belum Ada Data Harga</h3>
                            <p class="text-sm text-text-muted">
                                Daftar harga sampah belum tersedia. Silakan hubungi admin untuk informasi lebih lanjut.
                            </p>
                        </div>
                    @endif
                </section>

                <!-- Contact Section -->
                <section id="kontak" class="py-8 text-center" data-aos="fade-up">
                    <h2 class="mb-2 text-2xl font-bold">Kontak Dinas Lingkungan Hidup</h2>
                    <p class="max-w-2xl mx-auto mb-6 text-text-muted">
                        Untuk informasi lebih lanjut mengenai program Bank Sampah, kerja sama, atau pengaduan,
                        silakan hubungi:
                    </p>
                    <div class="max-w-md p-6 mx-auto bg-gray-50 rounded-xl">
                        <p class="text-sm text-text-muted">
                            <strong class="text-text-main">Dinas Lingkungan Hidup Kota ...</strong> <br>
                            Telepon: 08xx-xxxx-xxxx <br>
                            Email: dlh@example.com
                        </p>
                    </div>
                </section>
            </div>
        </section>

        <!-- Leaf Strip Section -->
        <section class="relative flex items-center justify-center text-center text-white bg-center bg-no-repeat bg-cover h-52" style="background-image: url('https://images.unsplash.com/photo-1669384537216-24740a56a2d5?q=80&w=1634&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"
            data-aos="zoom-in">
            <div class="absolute inset-0 leaf-overlay bg-gradient-to-t from-black/55 via-black/20 to-transparent">
            </div>
            <div class="relative z-10 max-w-2xl px-4">
                <p class="mb-2 text-sm opacity-90">Bersama kita wujudkan kota yang bersih dan sehat.</p>
                <p class="text-xl font-semibold">Kurangi, Pilah, Manfaatkan Kembali Sampah Anda.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-6 border-t border-gray-200 bg-green-50">
        <div class="max-w-6xl px-4 mx-auto text-center sm:px-6 lg:px-8">
            <p class="text-sm text-text-muted">&copy; {{ date('Y') }} Dinas Lingkungan Hidup Kota – Sistem
                Informasi Bank Sampah.</p>
            <p class="mt-1 text-xs text-text-muted">Dikelola oleh Bank Sampah Pusat bekerja sama dengan seluruh Bank
                Sampah Unit.</p>
        </div>
    </footer>

    <!-- JS AOS + JS Animasi Kustom -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/masyarakat.js') }}"></script>

    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Script untuk topbar scrolled
        window.addEventListener('scroll', function() {
            const topbar = document.querySelector('.topbar');
            if (window.scrollY > 50) {
                topbar.classList.add('bg-slate-900/95', 'backdrop-blur-sm', 'shadow-lg');
            } else {
                topbar.classList.remove('bg-slate-900/95', 'backdrop-blur-sm', 'shadow-lg');
            }
        });
    </script>

</body>

</html>