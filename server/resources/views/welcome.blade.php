<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Roti API</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
    :root {
        --brown-dark: #3B1F0F;
        --brown-primary: #6B3F2A;
        --brown-light: #A0522D;
        --cream: #F5ECD7;
        --cream-light: #FAF5EC;
        --sage: #7D9B76;
        --sage-light: #C8D9C2;
    }
    * { box-sizing: border-box; }
    body { font-family: 'Poppins', sans-serif; background-color: var(--cream-light); color: var(--brown-dark); margin: 0; }
    h1, h2, h3, h4, h5, .font-heading { font-family: 'Playfair Display', serif; }

    /* NAVBAR */
    .navbar-custom { background-color: var(--brown-dark); padding: 0.8rem 0; box-shadow: 0 2px 10px rgba(0,0,0,0.3); }
    .navbar-custom .navbar-brand { font-family: 'Playfair Display', serif; font-style: italic; font-size: 1.5rem; color: var(--cream) !important; display: flex; align-items: center; gap: 0.5rem; }
    .navbar-custom .navbar-brand .material-icons { font-size: 1.6rem; color: var(--sage-light); }
    .navbar-custom .nav-link { border: 1.5px solid var(--sage-light); border-radius: 25px; color: var(--sage-light) !important; font-weight: 400; font-size: 0.9rem; padding: 0.5rem 1.3rem !important; margin-left: 10px; transition: color 0.2s; }
    .navbar-custom .nav-link:hover { color: var(--cream) !important; }
    .navbar-toggler { border-color: rgba(245,236,215,0.3); }
    .navbar-toggler-icon { filter: invert(1); }
    .btn-sage { background-color: var(--sage); color: white; border: none; border-radius: 25px; padding: 0.45rem 1.3rem; font-weight: 500; font-size: 0.9rem; transition: background 0.2s; }
    .btn-sage:hover { background-color: #6a8a63; color: white; }
    .btn-cream { background-color: var(--cream); color: var(--brown-dark); border: none; border-radius: 25px; padding: 0.45rem 1.3rem; font-weight: 500; font-size: 0.9rem; transition: background 0.2s; }
    .btn-cream:hover { background-color: #ecdfc7; color: var(--brown-dark); }

    /* HERO */
    .hero-section { background-color: var(--brown-dark); min-height: 92vh; display: flex; align-items: center; padding: 5rem 0 4rem; position: relative; overflow: hidden; }
    .hero-section::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle at 20% 80%, rgba(125,155,118,0.12) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(245,236,215,0.06) 0%, transparent 50%); }
    .hero-badge { background-color: rgba(125,155,118,0.25); color: var(--sage-light); border: 1px solid rgba(125,155,118,0.5); border-radius: 20px; padding: 0.3rem 1rem; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1.2rem; }
    .hero-badge .material-icons { font-size: 1rem; }
    .hero-title { font-family: 'Playfair Display', serif; font-size: clamp(2.2rem, 5vw, 3.8rem); font-style: italic; color: var(--cream); line-height: 1.15; margin-bottom: 1.2rem; }
    .hero-subtitle { color: var(--sage-light); font-size: 1rem; font-weight: 300; line-height: 1.7; margin-bottom: 2rem; max-width: 480px; }
    .hero-img { width: 100%; border-radius: 20px; object-fit: cover; height: 400px; box-shadow: 0 20px 60px rgba(0,0,0,0.4); }
    @media (max-width: 991px) { .hero-img { height: 260px; margin-top: 2.5rem; } .hero-title { font-size: 2.2rem; } }

    /* STATS BAR */
    .stats-bar { background-color: var(--sage); padding: 1.2rem 0; }
    .stat-item { text-align: center; color: white; }
    .stat-item .stat-num { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; display: block; }
    .stat-item .stat-label { font-size: 0.78rem; opacity: 0.85; }
    .stat-divider { border-left: 1px solid rgba(255,255,255,0.3); }
    @media (max-width: 575px) { .stat-divider { border-left: none; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 0.8rem; margin-top: 0.8rem; } }

    /* FEATURES */
    .features-section { background-color: var(--cream); padding: 5rem 0; }
    .section-eyebrow { font-size: 0.78rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: var(--sage); margin-bottom: 0.6rem; display: flex; align-items: center; gap: 0.4rem; }
    .section-eyebrow .material-icons { font-size: 1rem; }
    .section-title { font-family: 'Playfair Display', serif; font-style: italic; color: var(--brown-dark); font-size: clamp(1.8rem, 3vw, 2.4rem); margin-bottom: 0.8rem; }
    .section-sub { color: var(--brown-primary); font-size: 0.95rem; max-width: 520px; margin: 0 auto 3rem; }
    .feature-card { background: white; border-radius: 16px; padding: 2rem 1.8rem; border: 1px solid #e8dcc8; transition: transform 0.3s, box-shadow 0.3s; height: 100%; }
    .feature-card:hover { transform: translateY(-6px); box-shadow: 0 12px 35px rgba(107,63,42,0.13); }
    .feature-icon { width: 60px; height: 60px; background-color: var(--sage); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.2rem; }
    .feature-icon .material-icons { color: white; font-size: 1.7rem; }
    .feature-card h5 { font-family: 'Playfair Display', serif; color: var(--brown-dark); font-size: 1.15rem; margin-bottom: 0.6rem; }
    .feature-card p { color: var(--brown-primary); font-size: 0.88rem; line-height: 1.7; margin: 0; }

    /* ENDPOINTS */
    .endpoints-section { background-color: var(--brown-dark); padding: 5rem 0; }
    .endpoints-section .section-title { color: var(--cream); }
    .endpoints-section .section-sub { color: var(--sage-light); }
    .endpoint-item { background: rgba(245,236,215,0.05); border: 1px solid rgba(245,236,215,0.1); border-radius: 10px; padding: 0.9rem 1.2rem; margin-bottom: 0.7rem; display: flex; align-items: center; gap: 0.9rem; transition: background 0.2s; flex-wrap: wrap; }
    .endpoint-item:hover { background: rgba(245,236,215,0.09); }
    .method-badge { border-radius: 6px; padding: 0.2rem 0.65rem; font-size: 0.75rem; font-weight: 600; min-width: 60px; text-align: center; flex-shrink: 0; }
    .badge-get { background-color: var(--sage); color: white; }
    .badge-post { background-color: var(--brown-light); color: white; }
    .badge-put { background-color: #B8860B; color: white; }
    .badge-delete { background-color: #8B2020; color: white; }
    .endpoint-path { font-family: monospace; color: var(--cream); font-size: 0.9rem; }
    .endpoint-desc { color: var(--sage-light); font-size: 0.82rem; margin-left: auto; }
    .endpoint-group-title { color: var(--sage-light); font-size: 0.82rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem; }
    .endpoint-group-title .material-icons { font-size: 1.1rem; color: var(--sage); }
    .code-block { background: rgba(0,0,0,0.3); border: 1px solid rgba(245,236,215,0.1); border-radius: 10px; padding: 1.2rem 1.5rem; font-family: monospace; font-size: 0.85rem; color: var(--sage-light); margin-top: 2rem; }
    .code-block .code-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.5px; color: var(--sage); margin-bottom: 0.6rem; display: flex; align-items: center; gap: 0.4rem; }
    .code-block .code-label .material-icons { font-size: 0.9rem; }
    .code-key { color: var(--sage-light); }
    .code-val { color: var(--cream); }

    /* HOW TO */
    .howto-section { background-color: var(--cream-light); padding: 5rem 0; }
    .step-item { display: flex; align-items: flex-start; gap: 1.2rem; margin-bottom: 2.2rem; }
    .step-number { width: 48px; height: 48px; background-color: var(--brown-primary); color: var(--cream); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; flex-shrink: 0; }
    .step-item h6 { font-weight: 600; color: var(--brown-dark); margin-bottom: 0.3rem; font-size: 1rem; }
    .step-item p { color: var(--brown-primary); font-size: 0.88rem; margin: 0; line-height: 1.7; }
    .step-item code { background: rgba(107,63,42,0.1); color: var(--brown-primary); padding: 0.15rem 0.4rem; border-radius: 4px; font-size: 0.82rem; }

    /* CTA */
    .cta-section { background-color: var(--sage); padding: 5rem 0; text-align: center; }
    .cta-section .section-title { color: var(--cream-light); }
    .cta-section p { color: var(--cream-light); margin-bottom: 2rem; }

    /* FOOTER */
    .footer-custom { background-color: var(--brown-dark); color: var(--sage-light); padding: 2rem 0; text-align: center; font-size: 0.85rem; }
    .footer-brand { font-family: 'Playfair Display', serif; font-style: italic; color: var(--cream); display: inline-flex; align-items: center; gap: 0.3rem; }
    .footer-brand .material-icons { font-size: 1rem; color: var(--sage); }
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <span class="material-icons">bakery_dining</span>
            Toko Roti API
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-3">
                <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#endpoints">API Docs</a></li>
                <li class="nav-item"><a class="nav-link" href="#howto">Cara Pakai</a></li>
            </ul>
            <div class="d-flex gap-2 mt-2 mt-lg-0">
                <a href="{{ route('login') }}" class="btn btn-cream">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sage">Daftar Gratis</a>
            </div>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero-section">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <span class="material-icons"></span>
                    REST API untuk Toko Roti
                </div>
                <h1 class="hero-title">Kelola Toko Roti<br>dengan <em>API Modern</em></h1>
                <p class="hero-subtitle">Integrasikan data produk, pelanggan, dan pesanan toko roti Anda dengan mudah menggunakan API kami yang aman dan terdokumentasi.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-sage btn-lg px-4 d-inline-flex align-items-center gap-2">
                        <span class="material-icons" style="font-size:1.1rem;">rocket_launch</span>
                        Mulai Gratis
                    </a>
                    <a href="#endpoints" class="btn btn-cream btn-lg px-4 d-inline-flex align-items-center gap-2">
                        <span class="material-icons" style="font-size:1.1rem;">description</span>
                        Lihat Dokumentasi
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=700&q=80"
                     alt="Toko Roti"
                     class="hero-img">
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats-bar">
    <div class="container">
        <div class="row text-center g-3">
            <div class="col-6 col-sm-3">
                <div class="stat-item">
                    <span class="stat-num">5+</span>
                    <span class="stat-label">Tabel Database</span>
                </div>
            </div>
            <div class="col-6 col-sm-3 stat-divider">
                <div class="stat-item">
                    <span class="stat-num">20+</span>
                    <span class="stat-label">Endpoint API</span>
                </div>
            </div>
            <div class="col-6 col-sm-3 stat-divider">
                <div class="stat-item">
                    <span class="stat-num">100%</span>
                    <span class="stat-label">JSON Response</span>
                </div>
            </div>
            <div class="col-6 col-sm-3 stat-divider">
                <div class="stat-item">
                    <span class="stat-num">Free</span>
                    <span class="stat-label">API Key</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FEATURES --}}
<section class="features-section" id="features">
    <div class="container">
        <div class="text-center">
            <div class="section-eyebrow justify-content-center">
                <span class="material-icons">verified</span>
                Keunggulan
            </div>
            <h2 class="section-title">Mengapa Pilih API Kami?</h2>
            <p class="section-sub">Dirancang khusus untuk kebutuhan manajemen toko roti modern</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <span class="material-icons">key</span>
                    </div>
                    <h5>API Key Aman</h5>
                    <p>Setiap pengguna mendapat API Key unik. Akses API hanya dengan key yang valid dan terautentikasi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <span class="material-icons">sync_alt</span>
                    </div>
                    <h5>CRUD Lengkap</h5>
                    <p>Operasi Create, Read, Update, Delete tersedia untuk produk, pelanggan, pesanan, dan kategori.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <span class="material-icons">menu_book</span>
                    </div>
                    <h5>Dokumentasi Jelas</h5>
                    <p>Setiap endpoint terdokumentasi dengan contoh request, response JSON, dan kode status lengkap.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ENDPOINTS --}}
<section class="endpoints-section" id="endpoints">
    <div class="container">
        <div class="text-center">
            <div class="section-eyebrow justify-content-center" style="color:var(--sage);">
                <span class="material-icons">api</span>
                Dokumentasi
            </div>
            <h2 class="section-title">Daftar Endpoint API</h2>
            <p class="section-sub">Base URL: <code style="color:var(--sage-light); background:rgba(255,255,255,0.08); padding:0.2rem 0.6rem; border-radius:6px;">http://localhost:8000/api</code></p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="endpoint-group-title">
                    <span class="material-icons">inventory_2</span>
                    Produk
                </div>
                <div class="endpoint-item"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/produk</span><span class="endpoint-desc">Semua produk</span></div>
                <div class="endpoint-item"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/produk/{id}</span><span class="endpoint-desc">Detail produk</span></div>
                <div class="endpoint-item"><span class="method-badge badge-post">POST</span><span class="endpoint-path">/produk</span><span class="endpoint-desc">Tambah produk</span></div>
                <div class="endpoint-item"><span class="method-badge badge-put">PUT</span><span class="endpoint-path">/produk/{id}</span><span class="endpoint-desc">Update produk</span></div>
                <div class="endpoint-item"><span class="method-badge badge-delete">DEL</span><span class="endpoint-path">/produk/{id}</span><span class="endpoint-desc">Hapus produk</span></div>

                <div class="endpoint-group-title mt-4">
                    <span class="material-icons">people</span>
                    Pelanggan
                </div>
                <div class="endpoint-item"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/pelanggan</span><span class="endpoint-desc">Semua pelanggan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-post">POST</span><span class="endpoint-path">/pelanggan</span><span class="endpoint-desc">Tambah pelanggan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-put">PUT</span><span class="endpoint-path">/pelanggan/{id}</span><span class="endpoint-desc">Update pelanggan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-delete">DEL</span><span class="endpoint-path">/pelanggan/{id}</span><span class="endpoint-desc">Hapus pelanggan</span></div>
            </div>
            <div class="col-lg-6">
                <div class="endpoint-group-title">
                    <span class="material-icons">receipt_long</span>
                    Pesanan
                </div>
                <div class="endpoint-item"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/pesanan</span><span class="endpoint-desc">Semua pesanan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/pesanan/{id}</span><span class="endpoint-desc">Detail pesanan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-post">POST</span><span class="endpoint-path">/pesanan</span><span class="endpoint-desc">Buat pesanan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-put">PUT</span><span class="endpoint-path">/pesanan/{id}</span><span class="endpoint-desc">Update pesanan</span></div>
                <div class="endpoint-item"><span class="method-badge badge-delete">DEL</span><span class="endpoint-path">/pesanan/{id}</span><span class="endpoint-desc">Hapus pesanan</span></div>

                <div class="code-block">
                    <div class="code-label">
                        <span class="material-icons">code</span>
                        Contoh Request Header
                    </div>
                    <div><span class="code-key">GET</span> /api/produk HTTP/1.1</div>
                    <div><span class="code-key">Host:</span> <span class="code-val">localhost:8000</span></div>
                    <div><span class="code-key">Authorization:</span> <span class="code-val">Bearer YOUR_API_KEY</span></div>
                    <div><span class="code-key">Accept:</span> <span class="code-val">application/json</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- HOW TO --}}
<section class="howto-section" id="howto">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="section-eyebrow">
                    <span class="material-icons">help_outline</span>
                    Panduan
                </div>
                <h2 class="section-title">Cara Menggunakan API</h2>
                <p style="color:var(--brown-primary); font-size:0.9rem; line-height:1.8;">Mulai dari registrasi hingga request pertamamu hanya dalam 3 langkah mudah.</p>
            </div>
            <div class="col-lg-7">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div>
                        <h6>Daftar Akun</h6>
                        <p>Buat akun gratis dengan email dan password. Proses registrasi selesai dalam satu menit.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div>
                        <h6>Generate API Key</h6>
                        <p>Setelah login, masuk ke dashboard dan klik <strong>"Generate API Key"</strong> untuk mendapatkan key unikmu.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div>
                        <h6>Kirim Request</h6>
                        <p>Tambahkan API Key di setiap request: <code>Authorization: Bearer {api_key}</code></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container">
        <h2 class="section-title">Siap Mulai Integrasi?</h2>
        <p>Daftar sekarang dan dapatkan API Key gratis untuk memulai.</p>
        <a href="{{ route('register') }}" class="btn btn-cream btn-lg px-5 d-inline-flex align-items-center gap-2">
            <span class="material-icons" style="font-size:1.1rem;">person_add</span>
            Daftar Sekarang
        </a>
    </div>
</section>

{{-- FOOTER --}}
<footer class="footer-custom">
    <div class="container">
        <p class="mb-0">
            <span class="footer-brand">
                <span class="material-icons">bakery_dining</span>
                Toko Roti API
            </span>
            &nbsp;&copy; {{ date('Y') }} — UAS Pemrograman API
        </p>
    </div>
</footer>

</body>
</html>