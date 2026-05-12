# Steze Hotel Management System

Sebuah sistem informasi dan manajemen perhotelan yang dirancang untuk mempermudah operasional bisnis hotel. Aplikasi ini mencakup berbagai fitur manajemen dasar hingga pencetakan laporan operasional.

> [!IMPORTANT]
> **Pemberitahuan Kerahasiaan (Confidentiality Notice):**
> Repositori ini berisi struktur tingkat atas (high-level) dari aplikasi. Kode sumber inti, algoritma bisnis, dan logika sistem internal bersifat rahasia (Proprietary). Beberapa file dan konfigurasi krusial mungkin tidak disertakan di repositori publik ini untuk melindungi Hak Kekayaan Intelektual dan kerahasiaan bisnis perusahaan.

## 🚀 Fitur Utama
- **Manajemen Reservasi & Jadwal:** Modul untuk mengatur jadwal (schedule) dan operasional.
- **Portal Informasi:** Menyediakan halaman profil, berita, dan galeri untuk memberikan informasi.
- **Sistem Autentikasi:** Fitur login terpusat untuk keamanan kontrol akses (Admin & Staff).
- **Integrasi Dokumen & Hardware:**
  - Pembuatan laporan spreadsheet (terintegrasi dengan `phpoffice/phpspreadsheet`).
  - Pencetakan struk/nota langsung ke printer thermal (terintegrasi dengan `mike42/escpos-php`).
- **User Interface Interaktif:** Penggunaan SweetAlert2 untuk notifikasi aksi pengguna yang lebih elegan.

## 🛠️ Teknologi yang Digunakan
- **Bahasa Pemrograman:** PHP, HTML, CSS, JavaScript
- **Package Manager:** Composer (Backend), NPM (Frontend Dependencies)
- **Library Tambahan:** PHPSpreadsheet, ESC/POS PHP, SweetAlert2

## 📂 Struktur Direktori Utama
Struktur gambaran besar direktori dari aplikasi ini:

```text
steze-id/
├── admin/          # Panel kontrol khusus administrator dan staff
├── database/       # Konfigurasi / Skema database (Private)
├── home/           # Direktori halaman utama / front-end landing
├── index.php       # Entry point utama aplikasi
├── login.php       # Modul autentikasi pengguna
├── schedule.php    # Modul penjadwalan/reservasi
└── vendor/ & node_modules/ # Dependencies aplikasi
```

## 🔒 Lisensi & Hak Cipta
Aplikasi ini bersifat **Closed Source / Proprietary**. Segala logika bisnis, struktur database internal, dan kode spesifik milik perusahaan dirahasiakan dan hanya ditujukan untuk kepentingan dokumentasi portofolio tingkat tinggi (high-level architecture).
