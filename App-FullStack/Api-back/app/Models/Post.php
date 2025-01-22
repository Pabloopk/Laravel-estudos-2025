<?php

namespace App\Models;
// Define o namespace do modelo, organizando as classes e evitando conflitos de nomes.

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importa o trait `HasFactory`, que é usado para criar instâncias do modelo em testes e seeders.

use Illuminate\Database\Eloquent\Model;
// Importa a classe base `Model`, que fornece funcionalidades do Eloquent ORM para o modelo `Post`.

class Post extends Model
// Define a classe `Post`, que representa a tabela `posts` no banco de dados.
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    // Comentário para documentar o uso da factory associada ao modelo, útil em IDEs e ferramentas de análise de código.

    use HasFactory;
    // Inclui o trait `HasFactory`, permitindo o uso de factories para criar instâncias do modelo em testes ou seeds.

    protected $fillable = [
        'title',
        'body',
    ];
    // Define os campos que podem ser preenchidos em massa (`mass assignment`) ao criar ou atualizar um registro.
    // Isso protege contra a vulnerabilidade de `mass assignment`, permitindo apenas os campos especificados.

    public function user()
    // Define uma relação entre o modelo `Post` e o modelo `User`.
    {
        return $this->belongsTo(User::class);
        // Indica que cada `Post` pertence a um único `User` (relação "muitos-para-um").
        // O Laravel assume, por convenção, que a tabela `posts` possui uma coluna `user_id` que referencia a tabela `users`.
    }
}
