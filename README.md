# Informasi Mahasiswa
Nama: Grayven Chrivio Wangke
NIM: 312410435
Kelas: T1.24.A3

# Sistem Manajemen Barang (Inventory) - PHP MVC

Aplikasi sederhana manajemen stok barang yang dibangun menggunakan **PHP Native** dengan konsep **MVC (Model-View-Controller)**, Modular, dan Routing. Proyek ini dibuat untuk memenuhi tugas UAS Pemrograman Web.

## 🚀 Fitur

* **Arsitektur MVC:** Kode terstruktur (Model, View, Controller).
* **Routing App:** URL cantik menggunakan `.htaccess`.
* **Multi-Role Login:** Akses berbeda untuk **Admin** dan **User**.
* **CRUD Barang:** Tambah, Edit, Hapus (Khusus Admin).
* **Fitur Pencarian & Pagination:** Memudahkan pengelolaan data banyak.
* **Responsive Design:** Menggunakan Framework CSS **Bootstrap 5**.

## 🛠️ Teknologi yang Digunakan

* Bahasa: PHP (Native)
* Database: MySQL
* Frontend: HTML, CSS, Bootstrap 5
* Server: Apache (XAMPP)

## 📦 Cara Instalasi & Menjalankan

1.  **Siapkan Database:**
    * Buka PHPMyAdmin.
    * Buat database baru bernama `uas_oop`.
    * Import file SQL (atau jalankan query SQL tabel `users` dan `barang` yang sudah disediakan).

2.  **Konfigurasi Project:**
    * Pastikan folder project bernama `project-uas` disimpan di dalam `C:/xampp/htdocs/`.
    * **PENTING:** Cek file `.htaccess`. Pastikan baris `RewriteBase` sesuai dengan nama folder:
        ```apache
        RewriteBase /project-uas/
        ```

3.  **Jalankan Aplikasi:**
    * Buka browser dan akses: `http://localhost/project-uas/`

## 🔑 Akun Login (Default)

Gunakan akun berikut untuk masuk ke sistem:

| Role | Username | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `123` | Full Akses (CRUD) |
| **User** | `user` | `123` | Hanya Lihat & Cari |

---
**Catatan:** Pastikan modul `mod_rewrite` pada Apache di XAMPP sudah diaktifkan agar routing `.htaccess` berjalan lancar.
