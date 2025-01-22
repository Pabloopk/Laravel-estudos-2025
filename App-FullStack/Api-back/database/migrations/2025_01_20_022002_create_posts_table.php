<?php

use Illuminate\Database\Migrations\Migration;
// Importa a classe base para criar migrações no banco de dados.

use Illuminate\Database\Schema\Blueprint;
// Importa a classe `Blueprint`, que fornece métodos para definir a estrutura das tabelas.

use Illuminate\Support\Facades\Schema;
// Importa a facade `Schema`, usada para manipular o banco de dados (criar, alterar ou excluir tabelas).

return new class extends Migration
// Retorna uma classe anônima que estende `Migration`, permitindo definir as migrações para o banco de dados.
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            // Cria uma tabela chamada `posts` no banco de dados.

            $table->id();
            // Adiciona uma coluna de chave primária auto-incrementada chamada `id`.

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Cria uma coluna `user_id` como chave estrangeira, vinculada à tabela `users`.
            // `constrained()` automaticamente associa à tabela `users` baseada na convenção de nomenclatura.
            // `cascadeOnDelete()` garante que, ao excluir um usuário, todos os posts associados a ele sejam excluídos.

            $table->string('title');
            // Adiciona uma coluna `title` do tipo string para armazenar o título do post.

            $table->text('body');
            // Adiciona uma coluna `body` do tipo texto para armazenar o conteúdo do post.

            $table->timestamps();
            // Adiciona as colunas `created_at` e `updated_at` para registrar as datas de criação e atualização do post.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        // Remove a tabela `posts` caso a migração seja revertida.
    }
};
