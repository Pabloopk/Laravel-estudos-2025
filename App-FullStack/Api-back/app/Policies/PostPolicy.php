<?php

namespace App\Policies;
// Define o namespace da política, organizando a classe dentro do projeto.

use App\Models\Post;
// Importa o modelo `Post`, que será utilizado para verificar permissões relacionadas a postagens.

use App\Models\User;
// Importa o modelo `User`, que representa o usuário autenticado.

use Illuminate\Auth\Access\Response;
// Importa a classe `Response`, usada para permitir ou negar acesso com mensagens personalizadas.

class PostPolicy
// Define a classe `PostPolicy`, que contém as regras de autorização relacionadas ao modelo `Post`.
{
    public function modify(User $user, Post $post): Response
    // Define o método `modify`, que verifica se um usuário tem permissão para modificar um determinado post.
    {
        return $user->id === $post->user_id
        // Verifica se o `id` do usuário autenticado é igual ao `user_id` do post.
        // Se os IDs forem iguais, significa que o usuário é o proprietário do post.

        ? Response::allow()
        // Se a condição for verdadeira, permite a ação retornando `Response::allow()`.

        : Response::deny('nao');
        // Se a condição for falsa, nega a ação retornando `Response::deny()` com a mensagem personalizada "nao".
    }
}
