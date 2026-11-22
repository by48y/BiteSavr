<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Login | BiteSavr</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<style>
:root{--g:#2E9E5B;--gd:#1B5E3A;--o:#FF8A1F;--bg:#F4FAF5;--card:#fff;--tx:#12301F;--mu:#4d6a58;--bd:#d5e6da}
*{box-sizing:border-box;margin:0}
body{background:linear-gradient(160deg,var(--gd),var(--g));min-height:100vh;display:flex;align-items:center;justify-content:center;font:400 16px/1.55 Inter,system-ui,sans-serif;padding:20px}
.box{background:var(--card);border-radius:24px;padding:40px 36px;width:100%;max-width:420px;box-shadow:0 24px 60px #0004}
.logo{font-family:Poppins,sans-serif;font-weight:800;font-size:24px;color:var(--g);text-align:center;margin-bottom:6px}
.logo b{color:var(--o)}
.sub{text-align:center;color:var(--mu);font-size:14px;margin-bottom:28px}
h1{font-family:Poppins,sans-serif;font-size:20px;font-weight:700;color:var(--tx);text-align:center;margin-bottom:22px}
.field{margin-bottom:16px}
label{display:block;font-size:14px;font-weight:500;color:var(--tx);margin-bottom:6px}
input[type=email],input[type=password],input[type=text]{width:100%;padding:12px 16px;border:1px solid var(--bd);border-radius:12px;font:400 15px Inter,sans-serif;color:var(--tx);background:var(--bg);transition:border-color .2s}
input:focus{outline:none;border-color:var(--g)}
.btn-main{width:100%;background:var(--g);color:#fff;font:700 15px Poppins,sans-serif;padding:14px;border-radius:12px;border:0;cursor:pointer;transition:transform .2s,background .2s;margin-top:4px}
.btn-main:hover{background:var(--gd);transform:translateY(-1px)}
.divider{display:flex;align-items:center;gap:12px;margin:20px 0;color:var(--mu);font-size:13px}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--bd)}
.btn-google{width:100%;display:flex;align-items:center;justify-content:center;gap:10px;background:#fff;border:1.5px solid var(--bd);color:var(--tx);font:600 14px Inter,sans-serif;padding:13px;border-radius:12px;cursor:pointer;text-decoration:none;transition:box-shadow .2s,transform .2s}
.btn-google:hover{box-shadow:0 4px 16px #0001;transform:translateY(-1px)}
.btn-google svg{width:20px;height:20px}
.error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px 16px;border-radius:10px;font-size:14px;margin-bottom:16px}
.success-msg{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:12px 16px;border-radius:10px;font-size:14px;margin-bottom:16px}
.remember{display:flex;align-items:center;gap:8px;font-size:14px;color:var(--mu);margin-bottom:4px}
.remember input{width:16px;height:16px;accent-color:var(--g)}
.back{text-align:center;margin-top:20px;font-size:14px;color:var(--mu)}
.back a{color:var(--g);font-weight:500;text-decoration:none}
</style>
</head>
<body>
<div class="box">
    <div class="logo">Bite<b>Savr</b></div>
    <p class="sub">Surplus food marketplace Pekanbaru</p>
    <h1>Masuk ke Dashboard</h1>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="success-msg">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@bitesavr.id">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" style="margin:0">Ingat saya</label>
        </div>
        <button type="submit" class="btn-main">Masuk</button>
    </form>

    <div class="divider">atau</div>

    <a href="{{ route('auth.google') }}" class="btn-google">
        <svg viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/><path fill="none" d="M0 0h48v48H0z"/></svg>
        Masuk dengan Google
    </a>

    <div class="back">
        <a href="/">← Kembali ke Beranda</a>
    </div>
</div>
</body>
</html>
