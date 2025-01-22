<?php

namespace App\Http\Controllers;
// Define o namespace do controlador. Isso organiza as classes e evita conflitos de nomes.

use App\Models\Post;
// Importa o modelo `Post`, que será usado para manipular os dados de postagens no banco de dados.

use Illuminate\Http\Request;
// Importa a classe `Request` para lidar com os dados enviados nas requisições HTTP.

use Illuminate\Routing\Controllers\HasMiddleware;
// Interface usada para implementar middlewares diretamente no controlador.

use Illuminate\Routing\Controllers\Middleware;
// Classe usada para definir middlewares no controlador.

use Illuminate\Support\Facades\Gate;
// Importa o `Gate` para gerenciar permissões de ações, como edição e exclusão de posts.

class PostController extends Controller implements HasMiddleware
// Define a classe `PostController`, que gerencia as ações relacionadas a posts, implementando a interface `HasMiddleware` para middlewares.
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
            // Aplica o middleware `auth:sanctum` para proteger todas as rotas do controlador, exceto as ações `index` e `show`.
        ];
    }

    /**
     * Display a listing of the resource.
     * Exibe uma lista de posts.
     */
    public function index()
    {
        return Post::with('user')->latest()->get();
        // Retorna todos os posts, incluindo os dados do autor (`user`) e ordenados do mais recente para o mais antigo.
        // `with('user')` otimiza a busca, reduzindo o número de consultas ao banco.
    }

    /**
     * Store a newly created resource in storage.
     * Armazena um novo post no banco de dados.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:255',
            // O campo `title` é obrigatório e tem um limite máximo de 255 caracteres.

            'body' => 'required'
            // O campo `body` (conteúdo do post) é obrigatório.
        ]);

        $post = $request->user()->posts()->create($fields);
        // Cria o post associado ao usuário autenticado (`$request->user()`).

        return ['post' => $post, 'user' => $post->user];
        // Retorna os dados do post criado e os dados do usuário que o criou.
    }

    /**
     * Display the specified resource.
     * Exibe um post específico.
     */
    public function show(Post $post)
    {
        return ['post' => $post, 'user' => $post->user];
        // Retorna os dados do post e do autor associado.
    }

    /**
     * Update the specified resource in storage.
     * Atualiza um post específico.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);
        // Autoriza a ação usando a política de autorização `modify`. Garante que apenas usuários autorizados possam editar o post.

        $fields = $request->validate([
            'title' => 'required|max:255',
            // O campo `title` é obrigatório e tem um limite máximo de 255 caracteres.

            'body' => 'required'
            // O campo `body` é obrigatório.
        ]);

        $post->update($fields);
        // Atualiza os dados do post com os novos valores validados.

        return ['post' => $post, 'user' => $post->user];
        // Retorna os dados atualizados do post e do autor associado.
    }

    /**
     * Remove the specified resource from storage.
     * Remove um post do banco de dados.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);
        // Autoriza a ação de exclusão usando a política de autorização `modify`. Garante que apenas usuários autorizados possam deletar o post.

        $post->delete();
        // Remove o post do banco de dados.

        return ['message' => 'The post was deleted'];
        // Retorna uma mensagem indicando que o post foi excluído com sucesso.
    }
}
