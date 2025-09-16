<?php

// Define o namespace da classe (organização dentro do projeto Laravel)
namespace App\Http\Controllers;

// Importa o modelo Post (representa a tabela "posts" no banco de dados)
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
// Importa a classe Request (para lidar com requisições HTTP)
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    // Pega o usuário autenticado
    $user  = $request->user();

    // Busca um único post pelo slug e pelo ID do autor (garante que só o dono veja)
    $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();

    // Se não encontrar o post, retorna erro 404 em JSON
    if (!$post) {
        return response()->json(['error' => '404 not found'], 404);
    }

    // Retorna o post encontrado em formato de array (Laravel converte para JSON)
    return [
        'post' => [
            'id' => $post->id, // ID do post
            'title' => $post->title, // Título
            'cover' => $post->cover, // Imagem de capa
            'createdAt' => $post->created_at, // Data de criação
            'authorName' => $post->author->name, // Nome do autor (relacionamento)
            'tags' => $post->tags->implode('name', ', '), // Tags separadas por vírgula
            'body' => $post->body, // Conteúdo
            'slug' => $post->slug, // Slug do post
        ]
    ];
}

public function deletePost(string $slug, Request $request) {
    // Pega o usuário autenticado
    $user  = $request->user();

    // Busca o post pelo slug e pelo ID do autor
    $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();

    // Se não encontrar, retorna erro 404
    if (!$post) {
        return response()->json(['error' => '404 not found'], 404);
    }

    // Deleta o post encontrado
    $post->delete();

    // Retorna mensagem de sucesso em JSON
    return response()->json(['message' => 'Post deleted successfully'], 200);
}

public function createPost(Request $request) {
    // Pega o usuário autenticado
    $user = $request->user();

    // Valida os dados enviados na requisição
    $request->validate([
        'title' => 'required|string|max:255', // título obrigatório, até 255 caracteres
        'body' => 'required|string', // corpo obrigatório
        //'cover' => 'nullable|url', // (comentado) capa opcional em formato de URL
        //'tags' => 'nullable|array', // (comentado) tags opcionais como array
        'tags.*' => 'string|max:255', // cada tag deve ser string de até 255 caracteres
        'status' => 'in:draft,published', // status deve ser "draft" ou "published"
    ]);



    // Cria um novo objeto Post
    $post = new Post();
    $post->title = $request->input('title'); // define o título
    $post->body = $request->input('body'); // define o corpo do texto
    $post->authorId = $user->id; // define o ID do autor como o usuário autenticado

        if (!$request->has('status')){
            $post->status = 'DRAFT';
        }


    // Gera o slug baseado no título + timestamp para evitar duplicidade
    $post->slug = Str::slug($post->title). '-' . time();

    // Verifica se foi enviado um arquivo de capa
    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        if (! $file->isValid()) {
            return response()->json([
                'error' => 'Invalid file upload'
                ], 400);
        }

        // Confere se a extensão do arquivo é válida (só imagens permitidas)
        if (!in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            return response()->json([
                'error' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.'
                ], 400);
        }

        // Cria um nome único para o arquivo baseado no timestamp
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // Move o arquivo para a pasta "public/uploads"
        $file->move(public_path('uploads'), $filename);

        $post->cover = env('APP_URL') . 'uploads/' . $filename; // Define a URL da capa
    }
    $post->save();

    if ($request->has('tags')){
        $tags = explode(',', $request->input('tags'));
        foreach ($tags as $tag) {
            $tag = trim($tag);
            $tagModel = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($tagModel->id);
        };
    }
    // Retorna o post criado em formato JSON
    return response()->json([
         'post' => [
            'id' => $post->id, // ID do post
            'title' => $post->title, // Título
            'cover' => $post->cover, // Imagem de capa
            'createdAt' => $post->created_at, // Data de criação
            'authorName' => $post->author->name, // Nome do autor (relacionamento)
            'tags' => $post->tags->implode('name', ', '), // Tags separadas por vírgula
            'body' => $post->body, // Conteúdo
            'slug' => $post->slug, // Slug do post
        ]
        ], 201);
    }


       public function updatePost(string $slug, Request $request)
            {
                // Obtém o usuário autenticado
                $user = $request->user();

                // Busca o post pelo slug e garantindo que seja do autor logado
                $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();

                // Se não encontrar, retorna 404
                if (!$post) {
                    return response()->json(['error' => '404 not found'], 404);
                }

                // Validação "parcial": só valida campos presentes (sometimes)
                $validated = $request->validate([
                    'title' => 'sometimes|required|string|max:255',  // se enviado, é obrigatório e string até 255
                    'body' => 'sometimes|required|string',           // se enviado, é obrigatório
                    'status'=> 'sometimes|in:draft,published',        // se enviado, deve ser um desses valores
                    'cover' => 'sometimes|file|mimes:jpg,jpeg,png,gif|max:5120', // até 5MB
                    'tags' => 'sometimes|array',                     // se enviado, deve ser array
                    'tags.*' => 'string|max:255',                      // cada item do array deve ser string
                    'regenerate_slug' => 'sometimes|boolean',                   // se true, regenera o slug ao trocar título
                ]);

                // Atualiza o título (se foi enviado)
                if (array_key_exists('title', $validated)) {
                    $post->title = $validated['title'];

                    // Se o cliente pedir para regenerar o slug (ex.: após mudar título)
                    if ($request->boolean('regenerate_slug', false)) {
                        $post->slug = Str::slug($post->title) . '-' . time();
                    }
                }

                // Atualiza o corpo (se foi enviado)
                if (array_key_exists('body', $validated)) {
                    $post->body = $validated['body'];
                }

                // Atualiza o status (se foi enviado)
                if (array_key_exists('status', $validated)) {
                    $post->status = $validated['status'];
                }

                // Se veio uma nova capa, processa upload e substitui a antiga
                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');

                    // --- Opção A: usando Storage (recomendado) ---
                    // Remove a antiga se existir e estiver no disco 'public'
                    if ($post->cover && Storage::disk('public')->exists($post->cover)) {
                        Storage::disk('public')->delete($post->cover);
                    }

                    // Gera nome único e salva em storage/app/public/uploads
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('uploads', $filename, 'public'); // retorna "uploads/123456789.jpg"

                    // Salva o caminho relativo (ex.: "uploads/123.jpg")
                    $post->cover = $path;

                    // --- Opção B: se preferir manter compatível com seu createPost (descomente) ---
                    /*
                    $ext = $file->getClientOriginalExtension();
                    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                        return response()->json(['error' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.'], 400);
                    }

                    // Remove a antiga se quiser (quando você salva em public/uploads):
                    if ($post->cover && file_exists(public_path($post->cover))) {
                        @unlink(public_path($post->cover));
                    }

                    $filename = time() . '.' . $ext;
                    $file->move(public_path('uploads'), $filename);
                    $post->cover = 'uploads/' . $filename; // mantém padrão relativo
                    */
                }

                // Salva alterações principais do post
                $post->save();

                // Se vieram tags e o relacionamento existir, sincroniza
                // (Pressupõe relação many-to-many com modelo Tag; ajuste conforme seu projeto)
                if ($request->filled('tags') && method_exists($post, 'tags')) {
                    // Exemplo criando/obtendo tags por nome
                    $tagIds = [];
                    foreach ($request->input('tags', []) as $tagName) {
                        $tag = Tag::firstOrCreate(['name' => $tagName]);
                        $tagIds[] = $tag->id;
                    }
                    // Sincroniza para refletir exatamente as tags enviadas
                    $post->tags()->sync($tagIds);
                }

                // Retorna JSON com o post atualizado
                return response()->json([
                    'message' => 'Post updated successfully',
                    'post' => [
                        'id'         => $post->id,
                        'title'      => $post->title,
                        'cover'      => $post->cover,
                        'createdAt'  => $post->created_at,
                        'authorName' => $post->author->name,
                        'tags'       => method_exists($post, 'tags') ? $post->tags->implode('name', ', ') : null,
                        'body'       => $post->body,
                        'slug'       => $post->slug,
                        'status'     => $post->status ?? null,
                    ],
                ], 200);
            }

}


