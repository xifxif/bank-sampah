<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teknologi Bank Sampah Plastik - Bank Sampah DLH</title>

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
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
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

        .tech-card {
            transition: all 0.3s ease;
        }

        .tech-card:hover {
            transform: translateY(-4px);
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
                    Artikel Teknologi
                </span>
                <h1 class="mb-4 text-3xl font-bold md:text-4xl" data-aos="fade-up">
                    Teknologi Bank Sampah Plastik: Inovasi untuk Masa Depan Berkelanjutan
                </h1>
                <div class="flex items-center space-x-4 text-sm opacity-90" data-aos="fade-up" data-aos-delay="100">
                    <span>📅 Dipublikasikan 21 November 2025</span>
                    <span>•</span>
                    <span>⏱️ 10 menit baca</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <article class="py-12 bg-white">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            
            <!-- Featured Image -->
            <div class="mb-8 overflow-hidden rounded-2xl shadow-soft" data-aos="fade-up">
                <img src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?w=1200&h=600&fit=crop" 
                     alt="Teknologi Daur Ulang Plastik" 
                     class="object-cover w-full h-64 md:h-96">
            </div>

            <!-- Article Body -->
            <div class="mx-auto prose" data-aos="fade-up">
                <p class="text-lg leading-relaxed text-text-muted">
                    Sampah plastik telah menjadi salah satu tantangan lingkungan terbesar di era modern. 
                    Setiap tahun, jutaan ton plastik berakhir di lautan dan tempat pembuangan sampah, 
                    mencemari ekosistem dan mengancam kehidupan. Namun, teknologi bank sampah plastik 
                    hadir sebagai solusi inovatif yang mengubah sampah menjadi sumber daya bernilai.
                </p>

                <h2 class="text-text-main">Apa itu Teknologi Bank Sampah Plastik?</h2>
                <p>
                    Teknologi bank sampah plastik adalah sistem terintegrasi yang menggabungkan pengumpulan, 
                    pemilahan, pengolahan, dan daur ulang sampah plastik dengan bantuan teknologi digital. 
                    Sistem ini memungkinkan masyarakat untuk menyetor sampah plastik layaknya menabung di bank, 
                    dengan nilai yang dapat ditukar menjadi uang atau barang.
                </p>

                <div class="p-6 my-8 border-l-4 rounded-r-lg bg-cyan-50 border-cyan-500">
                    <h3 class="!mt-0 text-cyan-900">🎯 Fakta Menarik</h3>
                    <p class="mb-0 text-cyan-800">
                        Indonesia merupakan penyumbang sampah plastik kedua terbesar di dunia dengan produksi 
                        mencapai 3,2 juta ton per tahun. Namun, hanya sekitar 10% yang didaur ulang. 
                        Teknologi bank sampah plastik dapat meningkatkan angka ini secara signifikan.
                    </p>
                </div>

                <h2 class="text-text-main">Komponen Teknologi Bank Sampah Plastik</h2>

                <!-- Technology Cards -->
                <div class="grid grid-cols-1 gap-6 my-8 md:grid-cols-2">
                    <div class="p-6 tech-card rounded-xl bg-gradient-to-br from-blue-50 to-cyan-50 shadow-soft">
                        <div class="flex items-center justify-center w-12 h-12 mb-4 bg-blue-100 rounded-full">
                            <span class="text-2xl">📱</span>
                        </div>
                        <h3 class="!mt-0 text-blue-900">Aplikasi Mobile</h3>
                        <p class="text-sm text-blue-800">
                            Platform digital untuk registrasi nasabah, pencatatan transaksi, monitoring saldo, 
                            dan informasi harga sampah real-time.
                        </p>
                    </div>

                    <div class="p-6 tech-card rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 shadow-soft">
                        <div class="flex items-center justify-center w-12 h-12 mb-4 bg-green-100 rounded-full">
                            <span class="text-2xl">⚖️</span>
                        </div>
                        <h3 class="!mt-0 text-green-900">Smart Weighing System</h3>
                        <p class="text-sm text-green-800">
                            Timbangan digital yang terintegrasi dengan sistem untuk pencatatan otomatis 
                            dan akurat setiap transaksi penyetoran sampah.
                        </p>
                    </div>

                    <div class="p-6 tech-card rounded-xl bg-gradient-to-br from-purple-50 to-violet-50 shadow-soft">
                        <div class="flex items-center justify-center w-12 h-12 mb-4 bg-purple-100 rounded-full">
                            <span class="text-2xl">🤖</span>
                        </div>
                        <h3 class="!mt-0 text-purple-900">AI Sorting Machine</h3>
                        <p class="text-sm text-purple-800">
                            Mesin pemilah otomatis berbasis kecerdasan buatan yang dapat mengidentifikasi 
                            dan memisahkan jenis plastik dengan akurasi tinggi.
                        </p>
                    </div>

                    <div class="p-6 tech-card rounded-xl bg-gradient-to-br from-orange-50 to-amber-50 shadow-soft">
                        <div class="flex items-center justify-center w-12 h-12 mb-4 bg-orange-100 rounded-full">
                            <span class="text-2xl">♻️</span>
                        </div>
                        <h3 class="!mt-0 text-orange-900">Recycling Technology</h3>
                        <p class="text-sm text-orange-800">
                            Teknologi daur ulang modern yang mengubah plastik menjadi biji plastik (pellet), 
                            benang, hingga produk jadi berkualitas tinggi.
                        </p>
                    </div>
                </div>

                <h2 class="text-text-main">Proses Kerja Sistem Bank Sampah Plastik</h2>
                
                <div class="my-8 overflow-hidden rounded-2xl shadow-medium">
                    <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1200&h=500&fit=crop" 
                         alt="Proses Daur Ulang" 
                         class="object-cover w-full h-64">
                </div>

                <h3 class="text-text-main">1. Pengumpulan dan Registrasi</h3>
                <p>
                    Nasabah mendaftar melalui aplikasi atau langsung di bank sampah. Setiap nasabah 
                    mendapatkan akun digital yang mencatat seluruh transaksi penyetoran sampah plastik.
                </p>

                <h3 class="text-text-main">2. Penyetoran dan Penimbangan</h3>
                <p>
                    Sampah plastik yang sudah dipilah dibawa ke bank sampah. Petugas melakukan penimbangan 
                    menggunakan smart weighing system yang langsung mencatat data ke sistem digital.
                </p>

                <h3 class="text-text-main">3. Identifikasi dan Penilaian</h3>
                <p>
                    Sistem mengidentifikasi jenis plastik berdasarkan kategori:
                </p>
                <ul class="list-disc text-text-muted">
                    <li><strong>PET (Polyethylene Terephthalate)</strong> - Botol minuman, wadah makanan</li>
                    <li><strong>HDPE (High-Density Polyethylene)</strong> - Botol detergen, jerigen</li>
                    <li><strong>PVC (Polyvinyl Chloride)</strong> - Pipa, kabel</li>
                    <li><strong>LDPE (Low-Density Polyethylene)</strong> - Plastik kresek, bubble wrap</li>
                    <li><strong>PP (Polypropylene)</strong> - Tutup botol, sedotan</li>
                    <li><strong>PS (Polystyrene)</strong> - Styrofoam, tempat makan sekali pakai</li>
                </ul>

                <h3 class="text-text-main">4. Pencatatan Digital</h3>
                <p>
                    Semua data transaksi tercatat otomatis dalam sistem: jenis plastik, berat, harga per kg, 
                    total nilai, dan saldo nasabah. Nasabah dapat memantau saldo melalui aplikasi kapan saja.
                </p>

                <h3 class="text-text-main">5. Pemilahan Lanjutan</h3>
                <p>
                    Sampah plastik yang terkumpul dipilah lebih detail menggunakan AI sorting machine. 
                    Mesin ini dapat membedakan jenis plastik hingga tingkat warna dan tingkat kontaminasi.
                </p>

                <h3 class="text-text-main">6. Pengolahan dan Daur Ulang</h3>
                <p>
                    Plastik yang sudah dipilah masuk ke proses daur ulang:
                </p>
                <ul class="list-disc text-text-muted">
                    <li>Pencucian dan pembersihan dari kontaminan</li>
                    <li>Pencacahan menjadi serpihan kecil (flakes)</li>
                    <li>Peleburan dan pembentukan pellet</li>
                    <li>Produksi produk jadi atau bahan baku industri</li>
                </ul>

                <div class="p-6 my-8 rounded-xl bg-gradient-to-r from-green-50 to-blue-50">
                    <h3 class="!mt-0 text-green-dark">💡 Inovasi Terkini</h3>
                    <p class="mb-4 text-text-muted">
                        Beberapa bank sampah modern sudah menggunakan teknologi blockchain untuk transparansi 
                        pencatatan dan IoT (Internet of Things) untuk monitoring real-time kondisi penyimpanan 
                        sampah plastik.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 text-center bg-white rounded-lg">
                            <p class="text-2xl font-bold text-green">99.9%</p>
                            <p class="text-xs text-text-muted">Akurasi Pemilahan AI</p>
                        </div>
                        <div class="p-3 text-center bg-white rounded-lg">
                            <p class="text-2xl font-bold text-blue-600">24/7</p>
                            <p class="text-xs text-text-muted">Monitoring Online</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-text-main">Keuntungan Teknologi Bank Sampah Plastik</h2>

                <h3 class="text-text-main">Bagi Lingkungan</h3>
                <ul class="list-disc text-text-muted">
                    <li>Mengurangi volume sampah plastik di TPA hingga 70%</li>
                    <li>Mencegah pencemaran laut dan ekosistem</li>
                    <li>Mengurangi emisi karbon dari produksi plastik baru</li>
                    <li>Melestarikan sumber daya alam</li>
                </ul>

                <h3 class="text-text-main">Bagi Masyarakat</h3>
                <ul class="list-disc text-text-muted">
                    <li>Tambahan penghasilan dari penjualan sampah plastik</li>
                    <li>Lingkungan tempat tinggal lebih bersih dan sehat</li>
                    <li>Edukasi tentang pentingnya pengelolaan sampah</li>
                    <li>Kemudahan akses informasi melalui aplikasi digital</li>
                </ul>

                <h3 class="text-text-main">Bagi Industri</h3>
                <ul class="list-disc text-text-muted">
                    <li>Pasokan bahan baku daur ulang yang konsisten</li>
                    <li>Biaya produksi lebih rendah dibanding plastik virgin</li>
                    <li>Meningkatkan citra perusahaan yang ramah lingkungan</li>
                    <li>Mendukung ekonomi sirkular</li>
                </ul>

                <div class="my-8 overflow-hidden rounded-2xl shadow-medium">
                    <img src="https://images.unsplash.com/photo-1581094271901-8022df4466f9?w=1200&h=500&fit=crop" 
                         alt="Produk Daur Ulang" 
                         class="object-cover w-full h-64">
                </div>

                <h2 class="text-text-main">Produk Hasil Daur Ulang Plastik</h2>
                <p>
                    Teknologi modern memungkinkan plastik daur ulang diolah menjadi berbagai produk berkualitas:
                </p>

                <div class="grid grid-cols-1 gap-4 my-6 md:grid-cols-3">
                    <div class="p-4 text-center rounded-lg bg-gray-50">
                        <span class="block mb-2 text-3xl">👕</span>
                        <p class="font-medium text-text-main">Tekstil & Pakaian</p>
                        <p class="text-xs text-text-muted">Benang polyester dari botol PET</p>
                    </div>
                    <div class="p-4 text-center rounded-lg bg-gray-50">
                        <span class="block mb-2 text-3xl">🪑</span>
                        <p class="font-medium text-text-main">Furniture</p>
                        <p class="text-xs text-text-muted">Kursi, meja dari plastik PP/HDPE</p>
                    </div>
                    <div class="p-4 text-center rounded-lg bg-gray-50">
                        <span class="block mb-2 text-3xl">🧱</span>
                        <p class="font-medium text-text-main">Material Bangunan</p>
                        <p class="text-xs text-text-muted">Paving block, genteng plastik</p>
                    </div>
                    <div class="p-4 text-center rounded-lg bg-gray-50">
                        <span class="block mb-2 text-3xl">🛍️</span>
                        <p class="font-medium text-text-main">Kemasan</p>
                        <p class="text-xs text-text-muted">Botol, wadah makanan</p>
                    </div>
                    <div class="p-4 text-center rounded-lg bg-gray-50">
                        <span class="block mb-2 text-3xl">🚗</span>
                        <p class="font-medium text-text-main">Komponen Otomotif</p>
                        <p class="text-xs text-text-muted">Dashboard, bumper</p>
                    </div>
                    <div class="p-4 text-center rounded-lg bg-gray-50">
                        <span class="block mb-2 text-3xl">🎨</span>
                        <p class="font-medium text-text-main">Produk Kreatif</p>
                        <p class="text-xs text-text-muted">Tas, aksesori, seni</p>
                    </div>
                </div>

                <h2 class="text-text-main">Tantangan dan Solusi</h2>
                
                <div class="p-6 my-6 rounded-xl bg-red-50">
                    <h3 class="!mt-0 text-red-900">⚠️ Tantangan</h3>
                    <ul class="mb-0 text-red-800 list-disc">
                        <li>Biaya investasi teknologi yang cukup tinggi</li>
                        <li>Perlu edukasi berkelanjutan kepada masyarakat</li>
                        <li>Kontaminasi plastik yang menurunkan kualitas daur ulang</li>
                        <li>Fluktuasi harga pasar plastik daur ulang</li>
                    </ul>
                </div>

                <div class="p-6 my-6 rounded-xl bg-green-50">
                    <h3 class="!mt-0 text-green-900">✅ Solusi</h3>
                    <ul class="mb-0 text-green-800 list-disc">
                        <li>Dukungan pemerintah melalui subsidi dan kebijakan</li>
                        <li>Program edukasi intensif dan gamifikasi di aplikasi</li>
                        <li>Teknologi pencucian dan pemurnian yang lebih canggih</li>
                        <li>Kemitraan dengan industri untuk stabilitas pasar</li>
                    </ul>
                </div>

                <h2 class="text-text-main">Masa Depan Bank Sampah Plastik</h2>
                <p>
                    Teknologi bank sampah plastik terus berkembang dengan integrasi teknologi terkini:
                </p>
                <ul class="list-disc text-text-muted">
                    <li><strong>Machine Learning</strong> untuk prediksi volume sampah dan optimasi rute pengangkutan</li>
                    <li><strong>Blockchain</strong> untuk traceability produk daur ulang dari hulu ke hilir</li>
                    <li><strong>Vending Machine</strong> reverse yang menerima botol plastik dan memberikan reward langsung</li>
                    <li><strong>Chemical Recycling</strong> untuk mengolah plastik multilayer yang sulit didaur ulang secara mekanis</li>
                    <li><strong>Integrasi dengan Smart City</strong> untuk pengelolaan sampah berbasis data real-time</li>
                </ul>

                <div class="p-6 my-8 text-center rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-500">
                    <p class="mb-2 text-2xl font-bold text-white">Bergabunglah dengan Gerakan Daur Ulang!</p>
                    <p class="mb-4 text-cyan-50">
                        Setiap botol plastik yang Anda setor adalah kontribusi nyata untuk lingkungan yang lebih bersih
                    </p>
                    <div class="inline-flex px-6 py-3 text-sm font-semibold transition-all bg-white rounded-full text-cyan-600 hover:bg-cyan-50 hover:shadow-lg">
                        Temukan Bank Sampah Terdekat →
                    </div>
                </div>

                <h2 class="text-text-main">Kesimpulan</h2>
                <p>
                    Teknologi bank sampah plastik merupakan solusi komprehensif yang menggabungkan aspek lingkungan, 
                    ekonomi, dan sosial. Dengan terus berkembangnya teknologi digital dan sistem daur ulang, 
                    masa depan pengelolaan sampah plastik semakin cerah. Partisipasi aktif masyarakat menjadi 
                    kunci keberhasilan sistem ini dalam mewujudkan Indonesia yang lebih bersih dan berkelanjutan.
                </p>

                <p>
                    Mari bersama-sama mengubah paradigma sampah plastik dari masalah menjadi peluang. 
                    Setiap langkah kecil yang kita ambil hari ini adalah investasi untuk generasi masa depan 
                    yang lebih baik.
                </p>
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
                    <a href="{{ route('artikel.memilah') }}" class="block p-4 transition-all rounded-lg bg-gray-50 hover:shadow-medium hover:-translate-y-1">
                        <span class="inline-block px-2 py-1 mb-2 text-xs font-medium rounded-full text-green bg-green-50">Video</span>
                        <h4 class="mb-2 text-base font-semibold text-text-main">Cara Memilah Sampah di Rumah</h4>
                        <p class="text-sm text-text-muted">Dipublikasikan 15 Nov 2025</p>
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