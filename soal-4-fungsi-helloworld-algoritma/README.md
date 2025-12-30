## Task

teori algoritma fizzbuz kaya modulo :
$n % 4 == 0 habis dibagi 4
$n % 5 == 0 habis dibagi 5

shortcut : composer create-project laravel/laravel soal-4-fungsi-helloworld-algoritma

tes :
http://127.0.0.1:8000/api/helloworld?n=1
output : [1]

http://127.0.0.1:8000/api/helloworld?n=2
output : [1,2]

http://127.0.0.1:8000/api/helloworld?n=3
output : [1,2,3]

http://127.0.0.1:8000/api/helloworld?n=4
output : [1,2,3,"hello"]

http://127.0.0.1:8000/api/helloworld?n=5
output : [1,2,3,"hello","world"]

http://127.0.0.1:8000/api/helloworld?n=6
output : [1,2,3,"hello","world",6]

http://127.0.0.1:8000/api/helloworld-list?n=6
output:
[
"helloworld(1) => 1",
"helloworld(2) => 1 2",
"helloworld(3) => 1 2 3",
"helloworld(4) => 1 2 3 hello",
"helloworld(5) => 1 2 3 hello world",
"helloworld(6) => 1 2 3 hello world 6"
]