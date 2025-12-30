
## Task
Struktur Pegawai

Pegawai 1 – Kepala Dinas
 ├── Pegawai 2 – Kepala Bidang 1
 │    └── Pegawai 4 – Staff
 └── Pegawai 3 – Kepala Bidang 2
      └── Pegawai 5 – Staff


Aturan :
- Setiap pegawai input log harian
- Status log:
Pending = default saat submit
Disetujui = oleh atasan langsung
Ditolak = oleh atasan langsung
Atasan hanya bisa memverifikasi log bawahan langsung
Ada 2 menu utama:
Log Harian (CRUD):
tambah log
liat log
edit log (kalo statusnya masi pending saja)
hapus log (kalo statusnya masi pending saja)
Verifikasi Log Harian (khusus atasan)
liat log pegawai (bawahan)
button setuju & tolak (sertakan catatan)
Kepala bidang yang dapat memverifikasi staff langsung, klo kepala dinas gabisa

role-based access + approval flow dh oke

Pemahaman Business Process
hubungan atasan–bawahan :
Hubungan atasan–bawahan tidak bersifat bebas, tetapi langsung (direct report)
Pegawai tidak dapat berinteraksi atau mengambil keputusan terhadap pegawai yang bukan bawahannya langsung.
approval flow berjenjang/berlapis :
staff : menginput log harian, status awalny pending, dan log hny di verifikasi oleh kepbid masing”
kepbid : menginput log harianny sndri, memverif log staff (bawahanny), dan log kepbid diverif oleh kepdin
kepdin : memverif log kepbid saja dan tidak memverif log staff scr lgsg (krna kerjaanny kepbid) Log Kepala Dinas tidak diverifikasi oleh siapa pun. auto-approved secara sistem
artinya approval tdk lompat level, sesuai hierarki dan setiap log hanya memiliki satu pihak verifikator
membatasi aksi user sesuai peran
staff : bisa create, see, edit, delete logny sndri selama statusny pending, tdk bisa melihat log pegawai lain dan tdk bisa memverif logny sndri
kepbid : bisa mengelola logny sndri dan melihat serta memverif log staff dibawahny. tdk bisa memverif logny sndri dan staff bidang lainnya
kepdin : bisa mengelola log milik sndri dan melihat serta memverif log kepbid. tdk bisa memverif log staff. Log Kepala Dinas tidak diverifikasi oleh siapa pun. auto-approved secara sistem
Siklus approval
pending > yes = approved; > no = rejected
kalau sudah approved/rejected sifatnya final (tdk bs di edit/dihpus)
Verifikasi hanya berlaku untuk bawahan langsung.
penolakan disertai catatan sbg feedback dan evaluasi
log bersifat harian (1 hari = 1 log tp ringkasan)
Perubahan struktur organisasi memengaruhi alur verifikasi

ENTITAS
user (pegawai)
id_user (PK) UNIK
user_name
email_user
user_password
role > enum: staff, kepala_bidang, kepala_dinas
supervisor_id (FK > users.id, nullable)
created_at
updated_at
notes :
Kepala Dinas > supervisor_id = NULL  
Kepala Bidang > supervisor_id = id Kepala Dinas
Staff > supervisor_id = id Kepala Bidang

daily_logs
id_logs (PK) UNIK
user_id (FK > users.id)
log_date (date) UNIK
activity_summary (text)
status > enum: pending, approved, rejected
verified_by (FK > users.id, nullable)
verification_note (text, nullable)
verified_at (timestamp, nullable)
created_at
updated_at

RELASI
1 user hanya boleh 1 log per hari
1 user bisa memverifikasi banyak log (sesuai banyaknya pegawai, dan 1 log masing” pegawai dalam 1 hari)
1 atasan memiliki banyak bawahan

composer create-project laravel/laravel soal-1-log-harian-web
Remove-Item -Recurse -Force .\soal-1-log-harian-web
cd soal-1-log-harian-web
composer require laravel/ui
php artisan ui tailwind --auth
npm install
npm run build
php artisan config:clear
php artisan make:migration create_custom_schema
php artisan make:model DailyLog
php artisan serve