Data Provinsi:
https://wilayah.id/api/provinces.json

## Step klo lupa
- Laravel auto:
composer create-project laravel/laravel api-wilayah
- Setting db jgn lupa (pakai mysql bkn sqlite)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_wilayah
DB_USERNAME=root
DB_PASSWORD=Nitaaaa07
- model & migration jgn lupa : php artisan make:model Province -m
- coba pke seeding dengan external API/memanfaatkan fitur Laravel HTTP Client untuk fetching data dr internet, trs simpen ke database secara otomatis?
- bikin migrasi seeder : php artisan make:seeder ProvinceSeeder
- cache : php artisan config:clear
- kadang ga kebaca krna klo pke data wilayah.id itu terbungkus dlm data, jadi hrus dipnggil lagi API nya : php artisan install:api
- http://127.0.0.1:8000/api/provinsi 

## Task
Buatl REST API untk melakukan CRUD ke data provinsi di Indonesia:
GET /api/provinsi => menampilkan daftar provinsi.
GET /api/provinsi/{id} => menampilkan detail provinsi.
POST /api/provinsi => menambah provinsi baru.
PUT /api/provinsi/{id} => mengupdate provinsi tertentu.
DELETE /api/provinsi/{id} => menghapus provinsi tertentu.

- aku baca" di internet pke pihak ketiga/extension yh, coba diantara ini:
a. Thunder Client
b. REST Client
c. Postman (ini paling awam)
- hasil ada di folder docs_penting menggunakan postman web untuk testing siklus CRUD