<?php

// Define o namespace da classe (organização dentro do projeto Laravel)
namespace App\Http\Controllers;

// Importa o modelo Post (representa a tabela "posts" no banco de dados)
use App\Models\Post;

// Importa a classe Request (para lidar com requisições HTTP)
use Illuminate\Http\Request;

// Declara a classe AdminController, que herda de Controller (controlador base do Laravel)
class AdminController extends Controller
{
    //
    // Função pública chamada getPosts, que recebe um objeto Request como parâmetro
    public function getPosts(Request $request) {
        // Obtém o usuário autenticado a partir da requisição
        $user = $request->user();

        // Define a quantidade de posts por página
        $posts_per_page = 10;

        // Busca os posts no banco de dados que pertencem ao usuário autenticado
        // e aplica a paginação (10 posts por página)
        $posts = Post::where('authorId', $user->id)->paginate($posts_per_page);

        // Cria um array vazio para armazenar os posts formatados
        $pagesPosts = [];

        // Loop que percorre cada post retornado
        foreach ($posts as $post) {
            // Monta um array com os dados formatados de cada post
            $pagesPosts[] = [
                'id' => $post->id, // ID do post
                'title' => $post->title, // Título do post
                'cover' => $post->cover, // Imagem de capa do post
                'createdAt' => $post->created_at, // Data de criação
                'authorName' => $post->author->name, // Nome do autor (relacionamento)
                'tags' => $post->tags->implode('name', ', '), // Lista de tags do post, separadas por vírgula
                'body' => $post->body, // Conteúdo do post
                'slug' => $post->slug, // Slug (link amigável do post)
                'status' => $post->status, // Status do post (ex: publicado, rascunho, etc.)
            ];
        }

        // Retorna uma resposta em formato array (JSON no Laravel automaticamente)
        return [
            'pagesPosts' => $pagesPosts, // Lista de posts formatados
            'page' => $posts->currentPage(), // Página atual da paginação
        ];
    }

    public function getPost(string $slug, Request $request) {
      $user  = $request->user();

        // Logic to retrieve a single post by slug
       $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();

        if (!$post) {
            return response()->json(['error' => '404 not found'], 404);
        }

        return [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'cover' => $post->cover,
                'createdAt' => $post->created_at,
                'authorName' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'body' => $post->body,
                'slug' => $post->slug,
            ]
        ];
    }
    public function deletePost(string $slug, Request $request) {
        $user  = $request->user();

          // Logic to retrieve a single post by slug
         $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();

          if (!$post) {
                return response()->json(['error' => '404 not found'], 404);
          }

          $post->delete();

          return response()->json(['message' => 'Post deleted successfully'], 200);
     }

     public function createPost(Request $request) {
        $user = $request->user();
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            //'cover' => 'nullable|url',
            //'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
            'status' => 'in:draft,published',
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
     }

}


