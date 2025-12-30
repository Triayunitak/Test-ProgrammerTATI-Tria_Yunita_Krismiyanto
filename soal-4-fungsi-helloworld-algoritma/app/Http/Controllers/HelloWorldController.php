<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    // main function
    public function index(Request $request)
    {
        // 1. ambil input n dr query param
        $n = $request->input('n');

        // n = null atau 0 / kosong 
        if (!$n) {
            return response()->json(['message' => 'Silakan isi parameter ?n=...'], 400);
        }

        // 2. function helloworld
        $hasil = $this->helloworld($n);

        // 3. return json respons
        return response()->json([
            'input_n' => $n,
            'hasil_deret' => $hasil // isi array dr fungsi helloworld
        ]);
    }

    // algoritma helloworld
    private function helloworld($n)
    {
        $output = []; // nampung output

        // loop 1 sampai n
        for ($i = 1; $i <= $n; $i++) {
            
            // apakah kelipatan 4 dan 5?
            if ($i % 4 == 0 && $i % 5 == 0) {
                $output[] = 'helloworld';
            }
            
            // apakah kelipatan 4?
            elseif ($i % 4 == 0) {
                $output[] = 'hello';
            }
            
            // apakah klipatan 5?
            elseif ($i % 5 == 0) {
                $output[] = 'world';
            }
            
            
            else {
                $output[] = $i;
            }
        }

        // msuk ke output
        return $output;
    }
}