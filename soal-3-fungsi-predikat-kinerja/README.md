## Task
Kalkulator Sederhana dgn 2 input : Hasil kerja & Perilaku
output : predikat (Sangat Baik, Baik, dsb) berdasarkan gambar tabel warna warni tadi

shortcut : composer create-project laravel/laravel soal-3-fungsi-predikat-kinerja

hasil di folder docs_penting
tes 1: http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=diatas ekspektasi&perilaku=diatas ekspektasi
output : {"hasil_kerja":"diatas ekspektasi","perilaku":"diatas ekspektasi","predikat":"Sangat Baik"}

tes 2: http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=diatas ekspektasi&perilaku=dibawah ekspektasi
output : {"hasil_kerja":"diatas ekspektasi","perilaku":"dibawah ekspektasi","predikat":"Kurang\/misconduct"}

tes 3 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=diatas%20ekspektasi&perilaku=sesuai%20ekspektasi
output : {"hasil_kerja":"diatas ekspektasi","perilaku":"sesuai ekspektasi","predikat":"Baik"}

tes 4 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=dibawah ekspektasi&perilaku=sesuai ekspektasi
output : {"hasil_kerja":"dibawah ekspektasi","perilaku":"sesuai ekspektasi","predikat":"Butuh perbaikan"}

tes 5 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=dibawah ekspektasi&perilaku=dibawah ekspektasi
output : {"hasil_kerja":"dibawah ekspektasi","perilaku":"dibawah ekspektasi","predikat":"Sangat Kurang"}

tes 6 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=dibawah ekspektasi&perilaku=diatas ekspektasi
output : {"hasil_kerja":"dibawah ekspektasi","perilaku":"diatas ekspektasi","predikat":"Butuh perbaikan"}

tes 7 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=sesuai ekspektasi&perilaku=diatas ekspektasi
output : {"hasil_kerja":"sesuai ekspektasi","perilaku":"diatas ekspektasi","predikat":"Baik"}

tes 8 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=sesuai ekspektasi&perilaku=dibawah ekspektasi
output : {"hasil_kerja":"sesuai ekspektasi","perilaku":"dibawah ekspektasi","predikat":"Kurang\/misconduct"}

tes 9 : http://127.0.0.1:8000/api/predikat-kinerja?hasil_kerja=sesuai ekspektasi&perilaku=sesuai ekspektasi
output : {"hasil_kerja":"sesuai ekspektasi","perilaku":"sesuai ekspektasi","predikat":"Baik"}

