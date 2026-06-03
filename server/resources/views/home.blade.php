<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Toko Roti API</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        :root { --brown-dark:#3B1F0F; --brown-primary:#6B3F2A; --brown-light:#A0522D; --cream:#F5ECD7; --cream-light:#FAF5EC; --sage:#7D9B76; --sage-light:#C8D9C2; }
        html { scroll-behavior: smooth; }
        body { font-family:'Poppins',sans-serif; background-color:var(--cream-light); color:var(--brown-dark); min-height:100vh; margin:0; }

        /* TOPBAR */
        .navbar-custom { background-color:var(--brown-dark); padding:0.8rem 0; box-shadow:0 2px 10px rgba(0,0,0,0.3); position:sticky; top:0; z-index:1000; }
        .navbar-custom .navbar-brand { font-family:'Playfair Display',serif; font-style:italic; color:var(--cream) !important; display:flex; align-items:center; gap:0.5rem; font-size:1.4rem; }
        .navbar-custom .navbar-brand .material-icons { color:var(--sage-light); }
        .navbar-custom .nav-link { border: 1.5px solid var(--sage-light); border-radius: 25px; color: var(--sage-light) !important; font-weight: 400; font-size: 0.9rem; padding: 0.5rem 1.3rem !important; margin-left: 10px; transition: color 0.2s; }
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active { color:var(--cream) !important; }
        .navbar-toggler { border-color: rgba(245,236,215,0.3); }
        .navbar-toggler-icon { filter: invert(1); }
        .user-badge { background:rgba(245,236,215,0.1); border:1px solid rgba(245,236,215,0.2); border-radius:20px; padding:0.35rem 1rem; color:var(--cream); font-size:0.85rem; display:flex; align-items:center; gap:0.4rem; white-space:nowrap; }
        .user-badge .material-icons { font-size:1rem; color:var(--sage-light); }
        .btn-logout  { background-color: var(--cream); color: var(--brown-dark); border: none; border-radius: 25px; padding: 0.45rem 1.3rem; font-weight: 500; font-size: 0.9rem; transition: background 0.2s; }
    .btn-cream:hover { background-color: #ecdfc7; color: var(--brown-dark); }
        .btn-logout:hover { background-color: #ecdfc7; color: var(--brown-dark); }
        .btn-logout .material-icons { font-size:1rem; }

        /* MAIN */
        .main-content { max-width:1140px; margin:0 auto; padding:2rem 1.5rem; }
        section { scroll-margin-top: 80px; }

        /* WELCOME BANNER */
        .welcome-banner { background-color:var(--brown-dark); border-radius:16px; padding:1.8rem 2rem; color:var(--cream); margin-bottom:1.8rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; }
        .welcome-banner h4 { font-family:'Playfair Display',serif; font-style:italic; font-size:1.5rem; margin:0 0 0.3rem; }
        .welcome-banner p { font-size:0.88rem; color:var(--sage-light); margin:0; }
        .welcome-icon { width:60px; height:60px; background:rgba(245,236,215,0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .welcome-icon .material-icons { font-size:1.8rem; color:var(--sage-light); }

        /* STATS */
        .stat-card { background:white; border-radius:14px; padding:1.3rem 1.5rem; border:1px solid #e8dcc8; display:flex; align-items:center; gap:1rem; height:100%; }
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .stat-icon .material-icons { font-size:1.4rem; color:white; }
        .stat-icon.brown { background-color:var(--brown-primary); }
        .stat-icon.sage { background-color:var(--sage); }
        .stat-icon.dark { background-color:var(--brown-dark); }
        .stat-label { font-size:0.78rem; color:var(--brown-light); margin-bottom:0.2rem; }
        .stat-value { font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; color:var(--brown-dark); line-height:1.2; word-break: break-all;}
        /* .stat-value.is-text { font-family:'Poppins',sans-serif; font-size:0.9rem; font-weight:500; word-break:break-all; line-height:1.4; } */

        /* API KEY CARD */
        .api-key-card { background:white; border-radius:16px; border:1px solid #e8dcc8; overflow:hidden; margin-bottom:1.5rem; }
        .api-key-header { background-color:var(--brown-dark); padding:1.2rem 1.8rem; display:flex; align-items:center; gap:0.8rem; }
        .api-key-header h5 { font-family:'Playfair Display',serif; color:var(--cream); margin:0; font-size:1.1rem; }
        .api-key-header .material-icons { color:var(--sage-light); }
        .api-key-body { padding:1.8rem; }
        .api-key-display { background:var(--cream-light); border:1.5px solid #e8dcc8; border-radius:10px; padding:1rem 1.2rem; display:flex; align-items:center; gap:1rem; margin-bottom:1.2rem; flex-wrap:wrap; }
        .api-key-display code { font-family:monospace; font-size:0.9rem; color:var(--brown-dark); flex:1; word-break:break-all; letter-spacing:0.5px; }
        .btn-copy { background-color:var(--sage); color:white; border:none; border-radius:8px; padding:0.4rem 1rem; font-size:0.82rem; display:flex; align-items:center; gap:0.3rem; cursor:pointer; transition:background 0.2s; white-space:nowrap; }
        .btn-copy:hover { background-color:#6a8a63; }
        .btn-copy .material-icons { font-size:1rem; }
        .btn-generate { background-color:var(--brown-primary); color:white; border:none; border-radius:10px; padding:0.65rem 1.5rem; font-size:0.9rem; font-weight:500; display:inline-flex; align-items:center; gap:0.5rem; cursor:pointer; transition:background 0.2s; }
        .btn-generate:hover { background-color:var(--brown-light); color:white; }
        .btn-generate .material-icons { font-size:1.1rem; }
        .btn-delete-key { background:transparent; color:#dc3545; border:1.5px solid #dc3545; border-radius:10px; padding:0.65rem 1.5rem; font-size:0.9rem; font-weight:500; display:inline-flex; align-items:center; gap:0.5rem; cursor:pointer; transition:all 0.2s; }
        .btn-delete-key:hover { background:#dc3545; color:white; }
        .btn-delete-key .material-icons { font-size:1.1rem; }
        .no-key-state { text-align:center; padding:2rem 1rem; }
        .no-key-state .material-icons { font-size:3rem; color:#e8dcc8; display:block; margin-bottom:0.8rem; }
        .no-key-state p { color:var(--brown-light); font-size:0.9rem; margin-bottom:1.2rem; }
        .usage-example { background:var(--cream-light); border-radius:10px; padding:1rem 1.2rem; margin-bottom:1.2rem; font-family:monospace; font-size:0.82rem; color:var(--brown-primary); }
        .usage-example .usage-label { font-family:'Poppins',sans-serif; font-size:0.72rem; text-transform:uppercase; letter-spacing:1.5px; color:var(--sage); margin-bottom:0.5rem; font-weight:600; }

        /* DOCS CARD */
        .docs-card { background:white; border-radius:16px; border:1px solid #e8dcc8; padding:1.5rem; margin-bottom:1.5rem; }
        .docs-card h6 { font-family:'Playfair Display',serif; color:var(--brown-dark); margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem; }
        .docs-card h6 .material-icons { color:var(--sage); font-size:1.2rem; }
        .endpoint-row { display:flex; align-items:center; gap:0.8rem; padding:0.6rem 0; border-bottom:1px solid #f0e8d8; flex-wrap:wrap; }
        .endpoint-row:last-child { border-bottom:none; }
        .method-badge { border-radius:5px; padding:0.15rem 0.55rem; font-size:0.72rem; font-weight:600; min-width:52px; text-align:center; }
        .badge-get { background-color:var(--sage); color:white; }
        .badge-post { background-color:var(--brown-light); color:white; }
        .badge-put { background-color:#B8860B; color:white; }
        .badge-delete { background-color:#8B2020; color:white; }
        .endpoint-path { font-family:monospace; font-size:0.85rem; color:var(--brown-dark); }
        .endpoint-desc { font-size:0.78rem; color:var(--brown-light); margin-left:auto; }

        /* ALERT */
        .alert-success-custom { background:#f0faf0; border:1px solid #c3e6cb; border-radius:10px; padding:0.8rem 1.2rem; color:#2d6a4f; font-size:0.85rem; display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem; }
        .alert-success-custom .material-icons { font-size:1.1rem; }

        @media (max-width:767px) { .main-content { padding:1.5rem 1rem; } .welcome-banner { padding:1.2rem; } }
    </style>
</head>
<body>

{{-- TOPBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid px-3">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="material-icons">bakery_dining</span>
            Toko Roti API
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#ringkasan">
                      Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#api-key">
                    API Key Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#docs">
                    Dokumentasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                <!-- <div class="user-badge">
                    <span class="material-icons">account_circle</span>
                    {{ Auth::user()->name }}
                </div> -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <span class="d-none d-md-inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="main-content">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <span class="material-icons">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- WELCOME + STATS --}}
    <section id="ringkasan">
        <div class="welcome-banner">
            <div>
                <h4>Halo, {{ Auth::user()->name }}! 👋</h4>
                <p>Kelola API Key dan pantau penggunaan API Anda di sini.</p>
            </div>
            <div class="welcome-icon">
                <span class="material-icons">bakery_dining</span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon brown">
                        <span class="material-icons">key</span>
                    </div>
                    <div>
                        <div class="stat-label">Status API Key</div>
                        <div class="stat-value" style="font-size:1rem;">
                            @if(Auth::user()->api_key)
                                <span style="color:#2d6a4f;">Aktif</span>
                            @else
                                <span style="color:var(--brown-light);">Belum ada</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon sage">
                        <span class="material-icons">inventory_2</span>
                    </div>
                    <div>
                        <div class="stat-label">Total Endpoint</div>
                        <div class="stat-value">20+</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon dark">
                        <span class="material-icons">account_circle</span>
                    </div>
                    <div>
                        <div class="stat-label">Akun</div>
                        <div class="stat-value">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- API KEY --}}
    <section class="api-key-card" id="api-key">
        <div class="api-key-header">
            <span class="material-icons">key</span>
            <h5>API Key Saya</h5>
        </div>
        <div class="api-key-body">
            @if(Auth::user()->api_key)
                <p style="font-size:0.88rem; color:var(--brown-primary); margin-bottom:1rem;">
                    Gunakan API Key berikut di header setiap request Anda.
                </p>
                <div class="api-key-display">
                    <code id="apiKeyText">{{ Auth::user()->api_key }}</code>
                    <button class="btn-copy" onclick="copyKey()">
                        <span class="material-icons">content_copy</span>
                        Salin
                    </button>
                </div>
                <div class="usage-example">
                    <div class="usage-label">Contoh Penggunaan</div>
                    <div>Authorization: Bearer <span style="color:var(--brown-dark);">{{ Auth::user()->api_key }}</span></div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <form method="POST" action="{{ route('api-key.generate') }}">
                        @csrf
                        <button type="submit" class="btn-generate">
                            <span class="material-icons">refresh</span>
                            Regenerate Key
                        </button>
                    </form>
                    <form method="POST" action="{{ route('api-key.delete') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-key" onclick="return confirm('Hapus API Key? Semua akses yang menggunakan key ini akan berhenti.')">
                            <span class="material-icons">delete</span>
                            Hapus Key
                        </button>
                    </form>
                </div>
            @else
                <div class="no-key-state">
                    <span class="material-icons">key_off</span>
                    <p>Anda belum memiliki API Key.<br>Generate sekarang untuk mulai menggunakan API.</p>
                    <form method="POST" action="{{ route('api-key.generate') }}">
                        @csrf
                        <button type="submit" class="btn-generate">
                            <span class="material-icons">add_circle</span>
                            Generate API Key
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </section>

    {{-- DOCS --}}
    <section class="docs-card" id="docs">
        <h6>
            <span class="material-icons">menu_book</span>
            Referensi Endpoint
        </h6>
        <div class="endpoint-row"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/api/produk</span><span class="endpoint-desc">Ambil semua produk</span></div>
        <div class="endpoint-row"><span class="method-badge badge-post">POST</span><span class="endpoint-path">/api/produk</span><span class="endpoint-desc">Tambah produk</span></div>
        <div class="endpoint-row"><span class="method-badge badge-put">PUT</span><span class="endpoint-path">/api/produk/{id}</span><span class="endpoint-desc">Update produk</span></div>
        <div class="endpoint-row"><span class="method-badge badge-delete">DEL</span><span class="endpoint-path">/api/produk/{id}</span><span class="endpoint-desc">Hapus produk</span></div>
        <div class="endpoint-row"><span class="method-badge badge-get">GET</span><span class="endpoint-path">/api/pesanan</span><span class="endpoint-desc">Ambil semua pesanan</span></div>
        <div class="endpoint-row"><span class="method-badge badge-post">POST</span><span class="endpoint-path">/api/pesanan</span><span class="endpoint-desc">Buat pesanan</span></div>
        <div class="endpoint-row"><span class="method-badge badge-put">PUT</span><span class="endpoint-path">/api/pesanan/{id}</span><span class="endpoint-desc">Update pesanan</span></div>
        <div class="endpoint-row"><span class="method-badge badge-delete">DEL</span><span class="endpoint-path">/api/pesanan/{id}</span><span class="endpoint-desc">Hapus pesanan</span></div>
    </section>

</div>

<script>
function copyKey() {
    const key = document.getElementById('apiKeyText').innerText;
    navigator.clipboard.writeText(key).then(() => {
        const btn = document.querySelector('.btn-copy');
        btn.innerHTML = '<span class="material-icons">check</span> Tersalin!';
        btn.style.background = '#2d6a4f';
        setTimeout(() => {
            btn.innerHTML = '<span class="material-icons">content_copy</span> Salin';
            btn.style.background = '';
        }, 2000);
    });
}
</script>

</body>
</html>