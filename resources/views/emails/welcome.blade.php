<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email Anda</title>
</head>
<body>
<h1>Selamat Datang, {{ $user->name }}!</h1>
<p>Terima kasih telah mendaftar di aplikasi kami. Harap verifikasi email Anda untuk mulai menggunakan layanan kami.</p>
<p>
    Klik tautan berikut untuk memverifikasi email Anda:
    <a href="{{ $verificationUrl }}">Verifikasi Email</a>
</p>
<p>Jika tautan di atas tidak berfungsi, salin dan tempel URL berikut ke browser Anda:</p>
<p>{{ $verificationUrl }}</p>
<p>Terima kasih!</p>
</body>
</html>
