<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    private $file = 'users.json';

    public function index()
    {
        $users = $this->readData();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'cep' => 'required|string|min:8|max:9',
        ]);

        // Busca o endereço na API ViaCEP
        $res = Http::get("https://viacep.com.br/ws/{$data['cep']}/json/");
        $endereco = $res->json();

        if (isset($endereco['erro'])) {
            return response()->json(['error' => 'CEP inválido'], 400);
        }

        $users = $this->readData();

        $newUser = [
            'id' => count($users) + 1,
            'nome' => $data['nome'],
            'email' => $data['email'],
            'cep' => $data['cep'],
            'endereco' => $endereco['logradouro'] ?? '',
            'bairro' => $endereco['bairro'] ?? '',
            'cidade' => $endereco['localidade'] ?? '',
            'estado' => $endereco['uf'] ?? '',
        ];

        $users[] = $newUser;
        $this->writeData($users);

        return response()->json($newUser, 201);
    }

    public function update(Request $request, $id)
    {
        $users = $this->readData();
        $index = array_search($id, array_column($users, 'id'));

        if ($index === false) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $users[$index] = array_merge($users[$index], $request->all());
        $this->writeData($users);

        return response()->json($users[$index]);
    }

    public function destroy($id)
    {
        $users = $this->readData();
        $filtered = array_filter($users, fn($u) => $u['id'] != $id);

        $this->writeData(array_values($filtered));

        return response()->json(['message' => 'Usuário removido com sucesso']);
    }

    private function readData()
    {
        $path = storage_path($this->file);
        if (!file_exists($path)) return [];
        return json_decode(file_get_contents($path), true);
    }

    private function writeData($data)
    {
        file_put_contents(storage_path($this->file), json_encode($data, JSON_PRETTY_PRINT));
    }
}
