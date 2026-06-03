<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Toko Roti API</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FAF5EC; min-height: 100vh; display: flex; flex-direction: column; }
        .auth-wrapper { flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; }
        .auth-card { background: white; border-radius: 20px; box-shadow: 0 8px 40px rgba(59,31,15,0.12); overflow: hidden; width: 100%; max-width: 900px; display: flex; min-height: 560px; }
       .auth-left { background: url('https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=600&q=80') center/cover no-repeat; padding: 3rem 2.5rem; display: flex; flex-direction: column; justify-content: space-between; width: 42%; position: relative; overflow: hidden; }
        .auth-left::before { content: ''; position: absolute; inset: 0; background: linear-gradient(160deg, rgba(59,31,15,0.88) 0%, rgba(107,63,42,0.80) 50%, rgba(59,31,15,0.75) 100%); z-index: 0; }
        .auth-left::after { content: ''; position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(245,236,215,0.06); border-radius: 50%; }
        .auth-logo { font-family: 'Playfair Display', serif; font-style: italic; color: #F5ECD7; font-size: 1.5rem; display: flex; align-items: center; gap: 0.5rem; z-index: 1; }
        .auth-logo .material-icons { color: #C8D9C2; }
        .auth-left-content { z-index: 1; position: relative; }
        .auth-left h2 { font-family: 'Playfair Display', serif; font-style: italic; color: #F5ECD7; font-size: 1.9rem; line-height: 1.3; margin-bottom: 1rem; }
        .auth-left p { color: #C8D9C2; font-size: 0.88rem; line-height: 1.7; margin: 0 0 1.2rem; }
        .benefit-item { display: flex; align-items: center; gap: 0.6rem; color: #C8D9C2; font-size: 0.83rem; margin-bottom: 0.6rem; z-index: 1; position: relative; }
        .benefit-item .material-icons { color: #7D9B76; font-size: 1.1rem; }
        .auth-left-img { width: 100%; border-radius: 12px; object-fit: cover; height: 140px; opacity: 0.75; z-index: 1; }
        .auth-right { padding: 2.5rem 2.5rem; flex: 1; display: flex; flex-direction: column; justify-content: center; }
        .auth-title { font-family: 'Playfair Display', serif; color: #3B1F0F; font-size: 1.8rem; margin-bottom: 0.3rem; }
        .auth-subtitle { color: #A0522D; font-size: 0.88rem; margin-bottom: 1.8rem; }
        .form-label { font-size: 0.85rem; font-weight: 500; color: #3B1F0F; margin-bottom: 0.4rem; }
        .form-control { border: 1.5px solid #e8dcc8; border-radius: 10px; padding: 0.65rem 1rem; font-size: 0.9rem; font-family: 'Poppins', sans-serif; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { border-color: #7D9B76; box-shadow: 0 0 0 3px rgba(125,155,118,0.15); outline: none; }
        .is-invalid { border-color: #dc3545 !important; }
        .invalid-feedback { font-size: 0.78rem; color: #dc3545; }
        .input-icon-wrap { position: relative; }
        .input-icon-wrap .material-icons { position: absolute; left: 0.8rem; top: 50%; transform: translateY(-50%); color: #A0522D; font-size: 1.1rem; pointer-events: none; }
        .input-icon-wrap .form-control { padding-left: 2.5rem; }
        .btn-primary-custom { background: linear-gradient(135deg, #6B3F2A, #A0522D); color: white; border: none; border-radius: 10px; padding: 0.7rem 1.5rem; font-weight: 500; font-size: 0.95rem; width: 100%; transition: opacity 0.2s; display: flex; align-items: center; justify-content: center; gap: 0.5rem; cursor: pointer; }
        .btn-primary-custom:hover { opacity: 0.9; color: white; }
        .auth-divider { text-align: center; color: #A0522D; font-size: 0.82rem; margin: 1rem 0; }
        .auth-link { color: #7D9B76; font-weight: 500; text-decoration: underline; }
        .auth-link:hover { color: #6a8a63; text-decoration: underline; }
        .navbar-mini { background-color: #3B1F0F; padding: 0.8rem 0; }
        .navbar-mini .navbar-brand { font-family: 'Playfair Display', serif; font-style: italic; color: #F5ECD7 !important; display: flex; align-items: center; gap: 0.5rem; font-size: 1.3rem; }
        .navbar-mini .material-icons { color: #C8D9C2; font-size: 1.3rem; }
        @media (max-width: 767px) { .auth-left { display: none; } .auth-card { max-width: 440px; } .auth-right { padding: 2.5rem 2rem; } }
    </style>
</head>
<body>

<nav class="navbar-mini">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand text-decoration-none">
            <span class="material-icons">bakery_dining</span>
            Toko Roti API
        </a>
    </div>
</nav>

<div class="auth-wrapper">
    <div class="auth-card">
        {{-- KIRI --}}
        <div class="auth-left">
            <div class="auth-logo">
                <span class="material-icons">bakery_dining</span>
                Toko Roti API
            </div>
            <div class="auth-left-content">
                <h2>Mulai perjalananmu!</h2>
                <p>Daftar gratis dan dapatkan API Key untuk mengelola data toko roti Anda.</p>
                <div class="benefit-item">
                    <span class="material-icons">check_circle</span>
                    API Key gratis selamanya
                </div>
                <div class="benefit-item">
                    <span class="material-icons">check_circle</span>
                    Akses semua endpoint CRUD
                </div>
                <div class="benefit-item">
                    <span class="material-icons">check_circle</span>
                    Dokumentasi lengkap tersedia
                </div>
            </div>
        </div>

        {{-- KANAN --}}
        <div class="auth-right">
            <h2 class="auth-title">Daftar Akun</h2>
            <p class="auth-subtitle">Isi form berikut untuk membuat akun baru</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-icon-wrap">
                        <span class="material-icons">person</span>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                               placeholder="John Doe" value="{{ old('username') }}" required autofocus>
                    </div>
                    @error('username') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-icon-wrap">
                        <span class="material-icons">mail</span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                    @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-icon-wrap">
                        <span class="material-icons">lock</span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Min. 8 karakter" required>
                    </div>
                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-icon-wrap">
                        <span class="material-icons">lock_reset</span>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary-custom">
                    <span class="material-icons" style="font-size:1.1rem;">person_add</span>
                    Buat Akun
                </button>
            </form>

            <div class="auth-divider">Sudah punya akun?<span>
                <a href="{{ route('login') }}" class="auth-link">Login sekarang</a></span>
            </div>
        </div>
    </div>
</div>

</body>
</html>