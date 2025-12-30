## Task

teori algoritma fizzbuz kaya modulo :
$n % 4 == 0 habis dibagi 4
$n % 5 == 0 habis dibagi 5

shortcut : composer create-project laravel/laravel soal-4-fungsi-helloworld-algoritma

tes :
http://127.0.0.1:8000/api/helloworld?n=1
output : {"input_n":"1","hasil_deret":[1]}

http://127.0.0.1:8000/api/helloworld?n=2
output : {"input_n":"2","hasil_deret":[1,2]}

http://127.0.0.1:8000/api/helloworld?n=3
output : {"input_n":"3","hasil_deret":[1,2,3]}

http://127.0.0.1:8000/api/helloworld?n=4
output : {"input_n":"4","hasil_deret":[1,2,3,"hello"]}

http://127.0.0.1:8000/api/helloworld?n=5
output : {"input_n":"5","hasil_deret":[1,2,3,"hello","world"]}

http://127.0.0.1:8000/api/helloworld?n=6
output : {"input_n":"6","hasil_deret":[1,2,3,"hello","world",6]}
