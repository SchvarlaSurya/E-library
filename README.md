# Panduan & Penjelasan Kode ReadSpace 🚀

Halo! Berikut adalah penjelasan dari semua kode teks (HTML/Tailwind/JavaScript) yang baru saja kita buat untuk proyek perpustakaan digital **ReadSpace**. 

Penjelasan ini dibuat sesederhana mungkin agar mudah dicerna, ibarat kita sedang membangun sebuah rumah.

---

## 1. File `app.blade.php` (Sebaga "Kerangka Rumah")
File ini sangat penting karena bertindak sebagai **fondasi atau kerangka utama** dari seluruh tampilan website. Setiap halaman (seperti beranda, profil, rak buku) akan menggunakan kerangka dari file ini.

### Apa saja yang ada di sini?
- **Pengaturan Tema Gelap/Terang (Dark Mode):** 
  Di dalam tag `<head>`, terdapat sepotong kode *JavaScript* yang mengecek apakah kamu sebelumnya memilih mode gelap. Ada juga tombol matahari/bulan di navigasi yang jika diklik, akan mengubah warna seluruh web dari terang ke gelap atau sebaliknya (`toggleDarkMode`).
- **Sistem Login (Clerk):**
  Alih-alih membuat sistem login dari nol yang rumit, kita menanamkan layanan dari **Clerk**. Kode ini secara otomatis menampilkan inisial avatar pengguna (seperti "AR" untuk Andi Rizky) setelah login dan menampilkan profil, jumlah buku di rak, jam baca, dan tiket langganan "Pro".
- **Menu Navigasi (Atas):**
  Bagian `<header>` berisi logo ReadSpace, menu pencarian, Notifikasi, dan Menu Profil. Ini dibikin responsif, artinya kalau dibuka di HP, akan muncul tombol strip tiga (hamburger menu) agar tetap rapi.
- **Sistem Bookmark / "Simpan ke Rak":**
  Di bagian paling bawah, ada fungsi bernama `toggleBookmark()`. Ini adalah "tukang kirim pesan" tanpa memuat ulang (refresh) halaman. Saat kamu klik ikon pita/bookmark di buku mana pun, kode ini diam-diam berbisik ke server, *"Hei, tolong simpan buku ini ke rak si pengguna!"*. Ikonnya akan langsung menyala berwarna emas.

---

## 2. File `home.blade.php` (Sebagai "Ruang Tamu")
Jika `app.blade.php` adalah kerangkanya, maka `home.blade.php` adalah **ruang tamu utama** tempat pengunjung pertama kali singgah. Halaman ini "meminjam" kerangka dari `app.blade.php` (ditandai dengan kode `@extends('layouts.app')`).

### Apa saja yang ada di sini?
- **Hero Section (Baleho Raksasa):**
  Di bagian paling atas, ada spanduk berwarna gelap elegan dengan tulisan *"Temukan Cerita yang Menghangatkan Hari"*. Ini digambar menggunakan kode HTML `<section>` dan dipercantik dengan *Tailwind CSS* untuk membentuk bayangan dan warna transparan (`bg-white/10`).
- **Sidebar (Menu Kiri):**
  Terdapat menu di sebelah kiri (`<aside>`) yang menampilkan:
  - **Kategori Buku:** Menampilkan ikon-ikon (seperti Sejarah, Fiksi) yang dibuat menggunakan `lucide-icons`.
  - **Buku Sedang Dibaca:** Menampilkan persentase progress membaca buku terakhir (contoh: *Pulang* oleh Leila S. Chudori, 67%).
  - **Banner Upgrade Pro:** Kotak berwarna keemasan berkilau (`bg-gradient-to-br`) yang bertugas menggoda pengguna agar berlangganan kelas *Premium*.
- **Pilihan Editor (Kanan Atas):**
  Ini adalah area konten utama. Menampilkan rekomendasi buku andalan (seperti *Bumi Manusia*). Kita desain dengan gaya kartu yang besar (`rounded-[2rem]`) yang akan sedikit terangkat dan bayangannya membesar saat kursor diarahkan ke sana (`hover:-translate-y-1 hover:shadow-xl`).
- **Buku Terpopuler (Kanan Bawah):**
  Adalah rak buku berjajar (seperti *Milk and Honey* dll). Menariknya, jika kursor digeser ke atas buku ini, penutup hitam perlahan akan muncul (`opacity-0 group-hover:opacity-100`) menampilkan tombol "Detail Buku".
- **Banner Bawah (Penutup):**
  Setelah melihat semua buku, dibagian paling bawah diletakkan banner besar untuk ajakan terakhir, *"Coba Gratis 30 Hari"*.

---

### Singkatnya:
1. **HTML** tugasnya menyusun bentuk seperti susunan batu bata (Header, Sidebar, Kotak Buku).
2. **Tailwind CSS** (seperti `flex`, `bg-zinc-900`, `text-white`) tugasnya mengecat, memberi jarak, membuat efek hover (interaksi sentuhan), dan membuatnya keren.
3. **JavaScript (JS)** tugasnya memberi *nyawa* (tombol dark-mode yang bisa diklik, sistem login yang mengecek kamu ini siapa, dan tombol simpan buku yang berfungsi langsung tanpa loading).

Semua harmoni ini dirakit dalam teknologi bernama **Laravel Blade** sehingga siap melayani semua pembaca dengan pengalaman yang modern, interaktif, dan memanjakan mata seperti aplikasi-aplikasi kelas dunia.
# E-library
