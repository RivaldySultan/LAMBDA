# LAMBDA (Layanan Administrasi & Manajemen Berkas Data Aktivitas)
### Badan Pusat Statistik (BPS) Kota Sukabumi

LAMBDA adalah platform web internal Badan Pusat Statistik (BPS) Kota Sukabumi yang dirancang untuk mengelola presensi dinas lapangan, pelaporan Catatan Kinerja Harian (CKH), verifikasi dokumentasi perjalanan dinas (swafoto & surat tugas), perekaman titik koordinat GPS (*geotagging*), serta pencetakan dokumen resmi berstandar tata naskah dinas A4 BPS.

---

## 0. Persiapan Perangkat Lunak (Sebelum Melakukan Clone)

Sebelum mengunduh proyek ini, pastikan perangkat komputer pengembang telah memiliki aplikasi penunjang berikut:

1. **Git for Windows**:
   - Digunakan untuk melakukan *cloning* repositori dan manajemen versi kode sumber.
   - Unduh dari: [git-scm.com/downloads](https://git-scm.com/downloads).
2. **XAMPP (PHP 8.2+ & MySQL)**:
   - Digunakan sebagai bundel web server lokal Apache dan sistem database MySQL/MariaDB.
   - Unduh dari: [apachefriends.org](https://www.apachefriends.org/index.html) (Pilih versi dengan PHP minimal 8.2).
3. **Composer**:
   - Manajer paket pustaka dependensi PHP untuk framework Laravel.
   - Unduh installer Windows: [getcomposer.org/download](https://getcomposer.org/download) (jalankan `Composer-Setup.exe`).

### Verifikasi Environment PATH di Terminal / Command Prompt
Buka Terminal / PowerShell / CMD baru dan pastikan perintah-perintah berikut berjalan normal:
```bash
git --version
php -v
composer -v
```
*(Jika salah satu perintah tidak dikenali, tambahkan folder instalasinya ke Environment Variables `PATH` Windows, misalnya `C:\xampp\php`).*

### Pengecekan Ekstensi PHP di `php.ini`
Buka file `C:\xampp\php\php.ini` (atau melalui XAMPP Control Panel > Config > PHP (php.ini)) dan pastikan baris berikut **tidak diawali titik koma (;) / aktif**:
```ini
extension=pdo_mysql
extension=fileinfo
extension=openssl
extension=mbstring
extension=curl
```

---

## 1. Panduan Lengkap dari Awal (*Fresh Clone Setup*)

Berikut adalah langkah-langkah terperinci mulai dari awal *clone* repositori hingga aplikasi siap dijalankan di browser:

### Langkah 1: Kloning Repositori dari GitHub
Buka terminal di folder kerja Anda (misalnya di `Documents` atau `C:\xampp\htdocs`), lalu jalankan:
```bash
git clone https://github.com/RivaldySultan/LAMBDA.git
cd LAMBDA
```

### Langkah 2: Pasang Seluruh Dependensi Vendor
Unduh dan pasang seluruh pustaka dependensi proyek menggunakan Composer:
```bash
composer install --ignore-platform-req=php
```
> **Catatan:** Flag `--ignore-platform-req=php` wajib disertakan jika menggunakan PHP 8.2 pada dependensi framework Laravel versi terbaru agar instalasi berjalan lancar tanpa terhalang pemeriksaan versi PHP ketat.

### Langkah 3: Siapkan File Konfigurasi Lingkungan (`.env`)
Salin file template `.env.example` menjadi file `.env`:
```bash
# Untuk pengguna Windows PowerShell / Command Prompt:
copy .env.example .env

# Atau pengguna Git Bash / Linux / macOS:
cp .env.example .env
```

### Langkah 4: Buat Kunci Enkripsi Aplikasi (*Application Key*)
Generate kunci enkripsi keamanan unik untuk Laravel:
```bash
php artisan key:generate
```

### Langkah 5: Nyalakan Apache & MySQL di XAMPP
1. Buka aplikasi **XAMPP Control Panel**.
2. Pada baris **Apache**, klik tombol **Start**.
3. Pada baris **MySQL**, klik tombol **Start** (pastikan modul berwarna hijau dan menggunakan port default `3306`).

### Langkah 6: Buat Database Baru di MySQL
Buka browser dan akses **phpMyAdmin** di alamat:  
👉 **[http://localhost/phpmyadmin](http://localhost/phpmyadmin)**

Buat database baru bernama `lambda_db` dengan collation `utf8mb4_unicode_ci`, atau jalankan perintah SQL berikut di tab SQL phpMyAdmin:
```sql
CREATE DATABASE lambda_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Langkah 7: Sesuaikan Pengaturan Database di File `.env`
Buka file `.env` di teks editor Anda (VS Code, Notepad, dll.), lalu pastikan blok database berisi konfigurasi berikut:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lambda_db
DB_USERNAME=root
DB_PASSWORD=
```
*(Catatan: Pengguna XAMPP standar memiliki user default `root` dengan password kosong).*

### Langkah 8: Jalankan Migrasi Database
Jalankan migrasi untuk membentuk seluruh skema tabel (`users`, `laporans`, `sessions`, dll.) ke dalam database `lambda_db`:
```bash
php artisan migrate
```

### Langkah 9: Jalankan Seeding Akun & Data Contoh Awal
Isi database dengan akun Administrator, staf pegawai BPS, tanda tangan dinas, serta contoh laporan kerja lapangan:
```bash
php artisan db:seed
```
> **Tips:** Jika di masa depan Anda ingin mereset database ke kondisi awal yang bersih kembali, cukup jalankan:
> ```bash
> php artisan migrate:fresh --seed
> ```

### Langkah 10: Pastikan Folder Unggahan Berkas Tersedia
Sistem membutuhkan direktori lokal berikut untuk menampung swafoto presensi, bukti tiket perjalanan, dan scan tanda tangan digital:
- `public/uploads/laporan/`
- `public/uploads/signatures/`

Sistem telah dilengkapi fungsi otomatis untuk membuat folder tersebut saat upload pertama, namun Anda juga dapat memastikannya dengan menjalankan:
```bash
php -r "if(!file_exists('public/uploads/laporan')) mkdir('public/uploads/laporan', 0755, true); if(!file_exists('public/uploads/signatures')) mkdir('public/uploads/signatures', 0755, true);"
```

### Langkah 11: Jalankan Server Lokal (*Development Server*)
Nyalakan server Laravel menggunakan perintah artisan:
```bash
php artisan serve
```

Aplikasi kini aktif dan dapat diakses di browser pada alamat:  
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## ⚡ Ringkasan Perintah Cepat (*Quick Commands for Developers*)

Bagi pengembang yang sudah terbiasa dengan ekosistem Laravel & XAMPP:

```bash
git clone https://github.com/RivaldySultan/LAMBDA.git
cd LAMBDA
composer install --ignore-platform-req=php
copy .env.example .env
php artisan key:generate
# (Pastikan MySQL XAMPP aktif & database 'lambda_db' telah dibuat)
php artisan migrate --seed
php artisan serve
```

---

## 2. Kredensial Akun Bawaan (*Default Accounts*)

Aplikasi menggunakan autentikasi fleksibel: Pengguna dapat login menggunakan **Username** ataupun **NIP** dengan kata sandi bawaan yang sama: **`password123`**.

### A. Akun Administrator
| Parameter | Kredensial Login |
|---|---|
| **Nama** | Admin BPS Kota Sukabumi |
| **Username** | `admin_bps` |
| **NIP** | `199001012024011001` |
| **Password** | `password123` |
| **Role & Akses** | `admin` — Mengarahkan ke Dashboard Utama & Modul Pengelolaan (`/dashboard`) |

### B. Akun Staf Pegawai BPS
Pengguna dengan role pegawai akan otomatis diarahkan ke **Portal Pegawai** (`/portal-pegawai`):

| Nama Pegawai | Username Login | NIP Login | Jabatan | Status TTD Digital |
|---|---|---|---|:---:|
| **Wishnu Eka Saputra** | `wishnu` | `197205181999031001` | Kepala Sub Bagian Umum | Tersedia |
| **Dani Jaelani** | `dani` | `196912101991121001` | Kepala Kantor BPS | Tersedia |
| **Taufik Januar** | `taufik` | `198101232001121002` | Asisten Statistisi Terampil | Unggah Mandiri |
| **Anita Rahminingrum** | `anita` | `197806041999122002` | Statistisi Ahli Muda | Unggah Mandiri |

*(Password seluruh akun pegawai di atas adalah: `password123`)*

---

## 3. Fitur Utama & Alur Penggunaan

### 📱 A. Alur Kerja Portal Pegawai (`/portal-pegawai`)
1. **Presensi & Pelaporan Harian**:
   - Pegawai melihat banner status di bagian atas: apakah sudah melapor hari ini, menunggu verifikasi, disetujui, atau perlu perbaikan.
   - Pegawai mengisi rincian waktu kerja (Waktu 1 s.d. Waktu 6).
2. **Geotagging Satelit GPS**:
   - Browser akan meminta izin akses lokasi (*Allow Location Access*). Koordinat garis lintang (*latitude*) dan garis bujur (*longitude*) terdeteksi otomatis sebagai bukti otentik kehadiran fisik di pos lapangan.
3. **Unggah Bukti Lapangan (1–2 Foto)**:
   - *Foto 1*: Swafoto (*selfie*) presensi lapangan langsung dari kamera ponsel atau file galeri.
   - *Foto 2 (Opsional)*: Dokumentasi wawancara responden survei, karcis/tiket perjalanan dinas, atau berkas Surat Perintah Tugas (SPT).
4. **Kelola Profil & Tanda Tangan Mandiri**:
   - Melalui tombol **"Profil & TTD"**, pegawai dapat memperbarui profil, mengganti password pribadi, dan mengunggah pindaian tanda tangan digital transparan (PNG/JPG).
5. **Cetak Mandiri Catatan Kinerja Harian (`/portal-pegawai/cetak`)**:
   - Pegawai dapat langsung mencetak lembar CKH bulanan mereka dengan Kop Surat resmi BPS Kota Sukabumi, tanda tangan digital ganda, serta lampiran galeri foto bukti dinas.

### 🖥️ B. Alur Kerja Administrator (`/dashboard`)
1. **Monitoring Dashboard**: Meninjau ringkasan metrik pegawai aktif, laporan masuk hari ini, dan kalender kerja dinamis.
2. **Kelola Pengguna (`/kelola-pengguna`)**: Menambah akun staf baru, mengubah jabatan/NIP, reset kata sandi, dan menonaktifkan akun staf.
3. **Verifikasi Laporan (`/laporan`)**: Memeriksa kesesuaian log jam kerja pegawai, meninjau foto selfie dan dokumentasi ukuran penuh, mengecek titik koordinat GPS di Google Maps, serta menyetujui (*Approve*) atau menolak (*Reject*) disertai catatan verifikasi.
4. **Cetak Dokumen Kantor (`/cetak`)**: Mencetak lembar rekapitulasi dinas kantor berstandar tata naskah A4 dengan pilihan atasan penilai dan lampiran foto dokumentasi.

---

## 4. Daftar Rute Aplikasi (*Route Reference*)

| Method | URI Path | Nama Rute | Hak Akses | Deskripsi Fungsi |
|---|---|---|:---:|---|
| `GET` | `/` | `login` | Publik | Halaman formulir login sistem |
| `POST` | `/login` | `login.submit` | Publik | Proses validasi login NIP/Username |
| `POST` | `/logout` | `logout` | Auth | Keluar dari sistem |
| `GET` | `/portal-pegawai` | `pegawai.portal` | Pegawai | Beranda portal laporan staf harian |
| `POST` | `/portal-pegawai/laporan` | `pegawai.laporan.store` | Pegawai | Simpan log harian, titik GPS, dan 2 foto bukti |
| `POST` | `/portal-pegawai/profil` | `pegawai.profil.update` | Pegawai | Update profil, ubah password, unggah TTD |
| `GET` | `/portal-pegawai/cetak` | `pegawai.cetak` | Pegawai | Cetak mandiri Catatan Kinerja Harian (CKH) |
| `GET` | `/dashboard` | `dashboard` | Admin | Dashboard metrik & kalender kerja |
| `GET` | `/kelola-pengguna` | `pengguna.index` | Admin | Tabel kelola akun pegawai (CRUD) |
| `POST` | `/kelola-pengguna` | `pengguna.store` | Admin | Tambah akun pegawai baru |
| `PUT` | `/kelola-pengguna/{id}` | `pengguna.update` | Admin | Simpan perubahan data pegawai |
| `DELETE` | `/kelola-pengguna/{id}` | `pengguna.destroy` | Admin | Hapus data akun pegawai |
| `GET` | `/laporan` | `laporan.index` | Admin | Filter & monitoring seluruh laporan pegawai |
| `POST` | `/laporan/{id}/verifikasi` | `laporan.verifikasi` | Admin | Setujui atau tolak laporan dinas pegawai |
| `GET` | `/cetak` | `cetak.index` | Admin | Lembar cetak dokumen kinerja BPS A4 |
| `GET` | `/kelola-teknis` | `teknis.index` | Admin | Modul pengelolaan teknis statistik |
| `GET` | `/kelola-survei` | `survei.index` | Admin | Modul instrumen sensus & survei lapangan |
| `GET` | `/info-bps` | `info.index` | Admin | Profil kantor & kontak BPS Kota Sukabumi |

---

## 5. Pemecahan Masalah Umum (*Troubleshooting*)

1. **`SQLSTATE[HY000] [2002] No connection could be made...`**:
   - Layanan MySQL di XAMPP belum dijalankan. Buka **XAMPP Control Panel** dan klik **Start** pada **MySQL**.
   - Pastikan database `lambda_db` sudah dibuat di phpMyAdmin.

2. **Perintah `composer install` gagal karena versi PHP**:
   - Pastikan menyertakan flag `--ignore-platform-req=php` saat menjalankan instalasi Composer:
     ```bash
     composer install --ignore-platform-req=php
     ```

3. **GPS Tidak Mendeteksi Titik Lokasi Lapangan**:
   - Pastikan Anda memilih **"Allow / Izinkan"** saat browser memunculkan *pop-up* izin lokasi GPS (*Geolocation*).
   - Jika browser menolak atau berada di jaringan komputer tanpa modul sensor GPS, sistem otomatis memasang titik koordinat pusat Kota Sukabumi sebagai nilai cadangan (*fallback*).

4. **Tampilan CSS / Gambar / Rute Mengalami Kendala Cache**:
   - Bersihkan seluruh tembolok aplikasi Laravel dengan menjalankan:
     ```bash
     php artisan optimize:clear
     ```

5. **`PHP Warning: file_uploads or upload_max_filesize exceeded`**:
   - Buka `php.ini` XAMPP dan pastikan nilai batas ukuran file cukup (misal: `upload_max_filesize = 10M` dan `post_max_size = 12M`).

---

## 6. Standar Desain & Lisensi

- **100% Inline SVG**: Seluruh ikon sistem menggunakan SVG murni tanpa karakter emotikon untuk kompatibilitas tampilan di berbagai sistem operasi.
- **Anti-Slop UI & Editorial Typography**: Mengadopsi prinsip desain bersih, fokus pada keterbacaan data, hierarki visual yang jelas, serta dioptimalkan untuk cetak fisik A4 (`@media print`).
- **Hak Cipta**: Dikembangkan untuk keperluan kedinasan **Badan Pusat Statistik (BPS) Kota Sukabumi**.

---
**Badan Pusat Statistik Kota Sukabumi**  
Jl. Selabintana No. 24, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114  
Laman Resmi: [sukabumikota.bps.go.id](https://sukabumikota.bps.go.id) | Email: `bps3272@bps.go.id`
