<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Recebe usuário e senha, e insere os mesmos na tabela de usuários. Se o usuário já exisir, retorna 409.
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request) {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        // Verifica se o usuário já existe
        $user = User::where('username', '=', $validated['username'])->first();

        if ($user === null) {
            // Hash da senha antes de criar o usuário
            // $validated['password'] = Hash::make($validated['password']);

            // Cria o usuário
            User::create($validated);

            return response()->json(['message' => 'Usuário criado com sucesso.'], 200);
        } else {
            return response()->json(['message' => 'Usuário já existente. Faça login.'], 409);
        }
    }
    // public function updatePassword(Request $request) {
    //     $validated = $request->validate([
    //         'username' => 'required|string|max:255',
    //         'password' => 'required|string|max:255'
    //     ]);

    //     // Verifica se o usuário já existe
    //     $user = User::where('username', '=', $validated['username'])->first();


    // }

    public function checkUser(Request $request) {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        // Verifica se o usuário já existe
        $user = User::where('username', '=', $validated['username'])->first();

        if ($user === null) {
            return response()->json(['message' => 'Erro no login.'], 401);
        } else {
            if ($user->password === $validated['password']) {
                return response()->json(['message' => 'Usuário encontrado. Credenciais autenticadas.'], 200);
            }
            return response()->json(['message' => 'Erro no login.'], 401);
        }
    }
}
