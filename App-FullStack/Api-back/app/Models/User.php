<?php

namespace App\Models;
// Define o namespace do modelo, organizando a classe `User` dentro do projeto.

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importa o trait `HasFactory`, utilizado para criar instâncias do modelo em testes e seeds.

use Illuminate\Foundation\Auth\User as Authenticatable;
// Importa a classe base `Authenticatable`, que implementa as funcionalidades de autenticação para o modelo `User`.

use Illuminate\Notifications\Notifiable;
// Importa o trait `Notifiable`, permitindo que o modelo `User` receba notificações.

use Laravel\Sanctum\HasApiTokens;
// Importa o trait `HasApiTokens`, necessário para a autenticação com tokens da biblioteca Laravel Sanctum.

class User extends Authenticatable
// Define a classe `User`, que representa a tabela `users` no banco de dados e possui funcionalidades de autenticação.
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    // Adiciona os traits `HasFactory`, `Notifiable` e `HasApiTokens`:
    // - `HasFactory`: Facilita a criação de instâncias do modelo em testes e seeds.
    // - `Notifiable`: Permite o envio de notificações.
    // - `HasApiTokens`: Habilita a autenticação via tokens usando Sanctum.

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    // Define os campos que podem ser preenchidos em massa (`mass assignment`), protegendo contra inserções indesejadas.

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // Define os atributos que serão ocultados ao serializar o modelo, como em respostas JSON.
    // Isso garante que informações sensíveis, como a senha, não sejam expostas.

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // Converte o campo `email_verified_at` para um objeto `datetime` automaticamente.

            'password' => 'hashed',
            // Indica que o campo `password` deve ser automaticamente criptografado ao ser definido.
        ];
    }

    public function posts()
    // Define a relação entre o modelo `User` e o modelo `Post`.
    {
        return $this->hasMany(Post::class);
        // Indica que um `User` pode ter muitos `Post` (relação "um-para-muitos").
        // Por convenção, o Laravel associa automaticamente a chave estrangeira `user_id` na tabela `posts`.
    }
}
