<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Memilah Sampah di Rumah - Bank Sampah DLH</title>

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

        .article-hero {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        .prose {
            max-width: 65ch;
        }

        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.75;
        }

        .prose h2 {
            margin-top: 2em;
            margin-bottom: 1em;
            font-size: 1.5em;
            font-weight: 700;
            line-height: 1.3;
        }

        .prose h3 {
            margin-top: 1.6em;
            margin-bottom: 0.6em;
            font-size: 1.25em;
            font-weight: 600;
            line-height: 1.4;
        }

        .prose ul {
            margin-top: 1.25em;
            margin-bottom: 1.25em;
            padding-left: 1.625em;
        }

        .prose li {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }

        .prose strong {
            font-weight: 600;
            color: #0f172a;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white text-text-main">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
        <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3.5">
                <!-- Brand Logo -->
                <div class="flex items-center space-x-2.5">
                    <span class="brand-logo"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-xs font-medium tracking-wider uppercase opacity-80 text-text-muted">DINAS LINGKUNGAN HIDUP</span>
                        <span class="text-sm font-semibold text-text-main">Bank Sampah Kota</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex items-center space-x-4 text-sm">
                    <a href="{{ route('welcome') }}"
                        class="pb-1 font-medium transition-colors text-text-main hover:text-green duration-250">Beranda</a>
                    <a href="{{ route('login') }}"
                        class="bg-green text-white px-4 py-2 rounded-full text-xs font-medium transition-all duration-250 hover:bg-green-dark hover:-translate-y-0.5 hover:shadow-lg">Dashboard</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Article Hero -->
    <section class="pt-24 pb-12 text-white article-hero">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <span class="inline-block px-3 py-1 mb-4 text-xs font-medium rounded-full bg-white/20 backdrop-blur-sm">
                    Video Tutorial
                </span>
                <h1 class="mb-4 text-3xl font-bold md:text-4xl" data-aos="fade-up">
                    Cara Memilah Sampah di Rumah dengan Benar
                </h1>
                <div class="flex items-center space-x-4 text-sm opacity-90" data-aos="fade-up" data-aos-delay="100">
                    <span>📅 Dipublikasikan 15 November 2025</span>
                    <span>•</span>
                    <span>⏱️ 8 menit baca</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <article class="py-12 bg-white">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            
            <!-- Featured Image -->
            <div class="mb-8 overflow-hidden rounded-2xl shadow-soft" data-aos="fade-up">
                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1200&h=600&fit=crop" 
                     alt="Pemilahan Sampah" 
                     class="object-cover w-full h-64 md:h-96">
            </div>

            <!-- Article Body -->
            <div class="mx-auto prose" data-aos="fade-up">
                <p class="text-lg leading-relaxed text-text-muted">
                    Memilah sampah di rumah adalah langkah awal yang penting dalam menjaga kelestarian lingkungan. 
                    Dengan pemilahan yang benar, sampah dapat didaur ulang secara efektif dan mengurangi volume 
                    sampah yang berakhir di tempat pembuangan akhir (TPA).
                </p>

                <h2 class="text-text-main">Mengapa Pemilahan Sampah Penting?</h2>
                <p>
                    Pemilahan sampah memberikan banyak manfaat, baik untuk lingkungan maupun ekonomi keluarga. 
                    Beberapa alasan pentingnya memilah sampah:
                </p>
                <ul class="list-disc text-text-muted">
                    <li><strong>Mengurangi pencemaran lingkungan</strong> - Sampah yang dipilah dengan benar dapat didaur ulang dan mengurangi polusi</li>
                    <li><strong>Menghemat sumber daya alam</strong> - Daur ulang sampah mengurangi kebutuhan bahan baku baru</li>
                    <li><strong>Menambah penghasilan</strong> - Sampah yang dipilah dapat dijual ke bank sampah</li>
                    <li><strong>Mengurangi volume TPA</strong> - Semakin sedikit sampah yang dibuang ke TPA, semakin baik untuk lingkungan</li>
                </ul>

                <h2 class="text-text-main">Jenis-Jenis Sampah yang Perlu Dipilah</h2>
                
                <div class="p-6 my-6 rounded-xl bg-blue-50">
                    <h3 class="!mt-0 text-blue-900">1. Sampah Organik (Kompos)</h3>
                    <p class="text-blue-800">
                        Sampah organik adalah sampah yang berasal dari makhluk hidup dan mudah terurai secara alami.
                    </p>
                    <p class="text-sm text-blue-700">
                        <strong>Contoh:</strong> Sisa sayuran, kulit buah, daun kering, sisa makanan, ampas kopi/teh
                    </p>
                </div>

                <div class="p-6 my-6 rounded-xl bg-yellow-50">
                    <h3 class="!mt-0 text-yellow-900">2. Sampah Anorganik</h3>
                    <p class="text-yellow-800">
                        Sampah anorganik adalah sampah yang tidak mudah terurai dan dapat didaur ulang.
                    </p>
                    <p class="text-sm text-yellow-700">
                        <strong>Contoh:</strong> Plastik, kertas, kardus, kaleng, botol kaca, logam
                    </p>
                </div>

                <div class="p-6 my-6 rounded-xl bg-red-50">
                    <h3 class="!mt-0 text-red-900">3. Sampah B3 (Bahan Berbahaya dan Beracun)</h3>
                    <p class="text-red-800">
                        Sampah B3 memerlukan penanganan khusus karena mengandung bahan berbahaya.
                    </p>
                    <p class="text-sm text-red-700">
                        <strong>Contoh:</strong> Baterai, lampu neon, obat kedaluwarsa, kaleng aerosol
                    </p>
                </div>

                <!-- Video Section -->
                <div class="my-8 overflow-hidden rounded-2xl shadow-medium">
                    <img src="https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=1200&h=600&fit=crop" 
                         alt="Tempat Sampah Terpilah" 
                         class="object-cover w-full h-64">
                </div>

                <h2 class="text-text-main">Langkah-Langkah Memilah Sampah di Rumah</h2>
                
                <h3 class="text-text-main">Step 1: Siapkan Tempat Sampah Terpisah</h3>
                <p>
                    Sediakan minimal 3 tempat sampah dengan warna berbeda untuk memudahkan pemilahan:
                </p>
                <ul class="list-disc text-text-muted">
                    <li><strong>Hijau</strong> untuk sampah organik</li>
                    <li><strong>Kuning</strong> untuk sampah anorganik</li>
                    <li><strong>Merah</strong> untuk sampah B3</li>
                </ul>

                <h3 class="text-text-main">Step 2: Bersihkan Sampah Anorganik</h3>
                <p>
                    Sebelum membuang sampah anorganik seperti botol plastik atau kaleng, pastikan untuk:
                </p>
                <ul class="list-disc text-text-muted">
                    <li>Membilasnya dengan air bersih</li>
                    <li>Mengeringkan sebelum dimasukkan ke tempat sampah</li>
                    <li>Melepas label jika memungkinkan</li>
                </ul>

                <h3 class="text-text-main">Step 3: Pisahkan Berdasarkan Jenis Material</h3>
                <p>
                    Untuk hasil maksimal, pisahkan lebih detail berdasarkan material:
                </p>
                <ul class="list-disc text-text-muted">
                    <li>Plastik: botol PET, kantong plastik, kemasan</li>
                    <li>Kertas: kardus, koran, majalah, kertas HVS</li>
                    <li>Logam: kaleng aluminium, besi</li>
                    <li>Kaca: botol kaca, pecahan kaca</li>
                </ul>

                <h3 class="text-text-main">Step 4: Kelola Sampah Organik</h3>
                <p>
                    Sampah organik dapat diolah menjadi kompos dengan cara:
                </p>
                <ul class="list-disc text-text-muted">
                    <li>Menggunakan komposter atau tong kompos</li>
                    <li>Mencampur dengan tanah dan mikroorganisme</li>
                    <li>Menunggu 2-3 bulan untuk proses pengomposan</li>
                    <li>Menggunakan hasil kompos untuk tanaman</li>
                </ul>

                <div class="p-6 my-8 border-l-4 rounded-r-lg bg-green-50 border-green">
                    <h3 class="!mt-0 text-green-dark">💡 Tips Praktis</h3>
                    <ul class="mb-0 list-disc text-text-muted">
                        <li>Mulai dari yang sederhana - minimal pisahkan organik dan anorganik</li>
                        <li>Libatkan seluruh anggota keluarga dalam pemilahan sampah</li>
                        <li>Buat jadwal rutin untuk mengangkut sampah ke bank sampah</li>
                        <li>Kurangi penggunaan plastik sekali pakai</li>
                        <li>Manfaatkan barang bekas yang masih bisa digunakan</li>
                    </ul>
                </div>

                <h2 class="text-text-main">Manfaat Ekonomi dari Memilah Sampah</h2>
                <p>
                    Dengan memilah sampah dan menyetorkannya ke bank sampah, Anda dapat memperoleh keuntungan finansial. 
                    Berikut estimasi harga beberapa jenis sampah:
                </p>

                <div class="grid grid-cols-1 gap-4 my-6 md:grid-cols-2">
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium text-text-muted">Botol Plastik (1 kg)</p>
                        <p class="text-xl font-bold text-green">Rp 3.000 - Rp 5.000</p>
                    </div>
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium text-text-muted">Kardus (1 kg)</p>
                        <p class="text-xl font-bold text-green">Rp 2.000 - Rp 3.000</p>
                    </div>
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium text-text-muted">Kaleng (1 kg)</p>
                        <p class="text-xl font-bold text-green">Rp 4.000 - Rp 6.000</p>
                    </div>
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium text-text-muted">Kertas (1 kg)</p>
                        <p class="text-xl font-bold text-green">Rp 1.500 - Rp 2.500</p>
                    </div>
                </div>

                <h2 class="text-text-main">Kesimpulan</h2>
                <p>
                    Memilah sampah di rumah adalah kebiasaan sederhana yang memberikan dampak besar bagi lingkungan. 
                    Dengan pemilahan yang tepat, kita tidak hanya menjaga kebersihan lingkungan, tetapi juga dapat 
                    menambah penghasilan keluarga. Mulailah dari hal kecil dan ajak keluarga untuk konsisten menerapkan 
                    pemilahan sampah setiap hari.
                </p>

                <div class="p-6 mt-8 rounded-xl bg-gradient-to-r from-green-50 to-blue-50">
                    <p class="mb-2 text-sm font-medium text-green-dark">Ingin tahu lebih lanjut?</p>
                    <p class="text-text-muted">
                        Kunjungi Bank Sampah terdekat atau hubungi Dinas Lingkungan Hidup untuk mendapatkan 
                        panduan lengkap dan informasi jadwal pengangkutan sampah.
                    </p>
                </div>
            </div>

            <!-- Share Section -->
            <div class="pt-8 mt-12 border-t border-gray-200" data-aos="fade-up">
                <p class="mb-4 text-sm font-medium text-text-muted">Bagikan artikel ini:</p>
                <div class="flex space-x-3">
                    <button class="px-4 py-2 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 hover:-translate-y-0.5">
                        Facebook
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-white transition-all bg-sky-500 rounded-lg hover:bg-sky-600 hover:-translate-y-0.5">
                        Twitter
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-white transition-all bg-green-600 rounded-lg hover:bg-green-700 hover:-translate-y-0.5">
                        WhatsApp
                    </button>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="pt-8 mt-12 border-t border-gray-200" data-aos="fade-up">
                <h3 class="mb-6 text-xl font-bold text-text-main">Artikel Terkait</h3>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <a href="{{ route('artikel.teknologi') }}" class="block p-4 transition-all rounded-lg bg-gray-50 hover:shadow-medium hover:-translate-y-1">
                        <span class="inline-block px-2 py-1 mb-2 text-xs font-medium rounded-full text-green bg-green-50">Artikel</span>
                        <h4 class="mb-2 text-base font-semibold text-text-main">Teknologi Bank Sampah Plastik</h4>
                        <p class="text-sm text-text-muted">Dipublikasikan 21 Nov 2025</p>
                    </a>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('welcome') }}" 
                   class="inline-flex items-center px-6 py-3 text-sm font-semibold transition-all bg-white border-2 rounded-full text-green border-green hover:bg-green hover:text-white duration-250">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </article>

    <!-- Footer -->
    <footer class="py-6 border-t border-gray-200 bg-green-50">
        <div class="max-w-6xl px-4 mx-auto text-center sm:px-6 lg:px-8">
            <p class="text-sm text-text-muted">&copy; {{ date('Y') }} Dinas Lingkungan Hidup Kota – Sistem
                Informasi Bank Sampah.</p>
            <p class="mt-1 text-xs text-text-muted">Dikelola oleh Bank Sampah Pusat bekerja sama dengan seluruh Bank
                Sampah Unit.</p>
        </div>
    </footer>

    <!-- JS AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>

</body>

</html>