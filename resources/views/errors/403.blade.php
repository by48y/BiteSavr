<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Akses Ditolak | BiteSavr</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&family=Inter:wght@400&display=swap" rel="stylesheet">
<style>
:root{--g:#2E9E5B;--o:#FF8A1F}
*{box-sizing:border-box;margin:0}
body{background:#F4FAF5;font:400 16px/1.6 Inter,sans-serif;color:#12301F;min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:20px}
h1{font:800 72px/1 Poppins,sans-serif;color:var(--o)}
h2{font:700 24px/1.2 Poppins,sans-serif;margin:12px 0 8px}
p{color:#4d6a58;max-width:46ch;margin:0 auto 22px}
a{display:inline-block;background:var(--g);color:#fff;font:700 15px Poppins,sans-serif;padding:12px 24px;border-radius:99px;text-decoration:none}
</style>
</head>
<body>
<div>
    <h1>403</h1>
    <h2>Akses Ditolak</h2>
    <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}</p>
    <a href="/">← Kembali ke Beranda</a>
</div>
</body>
</html>
