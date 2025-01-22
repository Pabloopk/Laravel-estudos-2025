<?php

namespace App\Http\Controllers;
// Define o namespace do controlador. É necessário para organizar as classes e evitar conflitos de nomes.

use App\Models\User;
// Importa o modelo `User`, que será usado para manipular os dados de usuários no banco de dados.

use Illuminate\Http\Request;
// Importa a classe `Request`, que contém os dados da requisição HTTP.

use Illuminate\Support\Facades\Hash;
// Importa a classe `Hash`, utilizada para verificar ou gerar hashes, como os de senhas.

class AuthController extends Controller
// Define a classe `AuthController`, que será responsável por gerenciar autenticação e registro de usuários.
{
    public function register(Request $request)
    // Método responsável por registrar um novo usuário.
    {
        $fields = $request->validate([
        // Valida os dados recebidos na requisição para garantir que estão no formato correto.
            'name' => 'required|max:255',
            // O campo `name` é obrigatório (`required`) e não pode ter mais de 255 caracteres.

            'email' => 'required|email|unique:users',
            // O campo `email` é obrigatório, deve ser um email válido e único na tabela `users`.

            'password' => 'required|confirmed'
            // O campo `password` é obrigatório e deve ter uma confirmação correspondente no campo `password_confirmation`.
        ]);

        $user = User::create($fields);
        // Cria um novo usuário no banco de dados com os dados validados.

        $token = $user->createToken($request->name);
        // Gera um token de autenticação para o usuário criado, usando o nome como identificador do token.

        return [
        // Retorna uma resposta em formato JSON contendo o usuário criado e o token de autenticação.
            'user' => $user,
            // Dados do usuário recém-criado.

            'token' => $token->plainTextToken
            // O token gerado em formato de texto simples.
        ];
    }

    public function login(Request $request)
    // Método responsável por autenticar um usuário.
    {
        $request->validate([
        // Valida os dados da requisição.
            'email' => 'required|email|exists:users',
            // O email é obrigatório, deve ser válido e deve existir na tabela `users`.

            'password' => 'required'
            // A senha é obrigatória.
        ]);

        $user = User::where('email', $request->email)->first();
        // Busca o usuário no banco de dados pelo email fornecido.

        if (!$user || !Hash::check($request->password, $user->password)) {
        // Verifica se o usuário existe e se a senha fornecida corresponde ao hash armazenado.
            return [
            // Se as credenciais estiverem incorretas, retorna um erro.
                'errors' => [
                    'email' => ['Seu login nao foi.']
                ]
            ];
        }

        $token = $user->createToken($user->name);
        // Gera um token de autenticação para o usuário.

        return [
        // Retorna uma resposta com os dados do usuário autenticado e o token.
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request)
    // Método responsável por realizar o logout do usuário.
    {
        $request->user()->tokens()->delete();
        // Apaga todos os tokens do usuário autenticado, invalidando o acesso.

        return [
        // Retorna uma mensagem de sucesso ao sair.
            'message' => 'Voce saiu'
        ];
    }
}
