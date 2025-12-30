# Test--ProgrammerTATI-Tria-Yunita-Krismiyanto
Tria Yunita Krismiyanto, penggunaan framework dengan dasar laravel. Bismillah lulus aaminn

Repository ini berisi hasil pengerjaan TUGAS INTERVIEW Programmer (Intern).

## Daftar Soal
- Soal 1: Sistem Log Harian Pegawai (Laravel + Blade & Tailwind)
- Soal 2: Buatlah REST API untuk melakukan operasi CRUD terhadap data provinsi di Indonesia
- Soal 3: Buatlah fungsi predikat_kinerja($hasil_kerja, $perilaku), yang akan menampilkan output
sesuai matriks dibawah ini
- Soal 4: Buatlah sebuah fungsi helloworld($n), yang akan menampilkan output deret bilangan 1 s/d
$n dengan ketentuan

Setiap soal memiliki folder dan README masing-masing.

## Task
Struktur Pegawai

Pegawai 1 – Kepala Dinas
 ├── Pegawai 2 – Kepala Bidang 1
 │    └── Pegawai 4 – Staff
 └── Pegawai 3 – Kepala Bidang 2
      └── Pegawai 5 – Staff


composer create-project laravel/laravel soal-1-log-harian-web
cd soal-1-log-harian-web
composer require laravel/ui
php artisan ui tailwind --auth
npm install
npm run build
php artisan config:clear