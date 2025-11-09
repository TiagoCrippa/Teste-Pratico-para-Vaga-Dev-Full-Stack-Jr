<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnderecoController extends Controller
{
    public function buscar(Request $request)
    {
        $cep = $request->input('cep');
        $response = Http::get("https://viacep.com.br/ws/$cep/json/")->json();
        return response()->json($response);
    }
}
