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
        // Cria a tabela `users`, responsável por armazenar as informações dos usuários.
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Adiciona uma coluna de chave primária auto-incrementada chamada `id`.

            $table->string('name');
            // Adiciona uma coluna `name` do tipo string para armazenar o nome do usuário.

            $table->string('email')->unique();
            // Adiciona uma coluna `email` do tipo string e define que os valores devem ser únicos (não podem se repetir).

            $table->timestamp('email_verified_at')->nullable();
            // Adiciona uma coluna `email_verified_at` do tipo timestamp. Pode ser nula e será usada para armazenar a data de verificação do e-mail.

            $table->string('password');
            // Adiciona uma coluna `password` para armazenar a senha do usuário.

            $table->rememberToken();
            // Adiciona uma coluna `remember_token`, usada para autenticação "Lembrar-me".

            $table->timestamps();
            // Adiciona as colunas `created_at` e `updated_at` para rastrear as datas de criação e atualização do usuário.
        });

        // Cria a tabela `password_reset_tokens`, responsável por armazenar os tokens para redefinição de senha.
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            // Adiciona uma coluna `email` que será a chave primária, armazenando o e-mail do usuário que solicitou a redefinição de senha.

            $table->string('token');
            // Adiciona uma coluna `token` para armazenar o token gerado para a redefinição de senha.

            $table->timestamp('created_at')->nullable();
            // Adiciona uma coluna `created_at` que armazena a data de criação do token, permitindo expiração.

        });

        // Cria a tabela `sessions`, responsável por armazenar informações sobre as sessões dos usuários.
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            // Adiciona uma coluna `id` como chave primária para identificar de forma única cada sessão.

            $table->foreignId('user_id')->nullable()->index();
            // Adiciona uma coluna `user_id` como chave estrangeira, relacionada ao usuário da sessão.
            // A coluna é opcional (nullable) e possui um índice para otimizar buscas.

            $table->string('ip_address', 45)->nullable();
            // Adiciona uma coluna `ip_address` para armazenar o endereço IP da sessão.
            // A coluna tem um tamanho máximo de 45 caracteres para suportar IPv6.

            $table->text('user_agent')->nullable();
            // Adiciona uma coluna `user_agent` para armazenar informações sobre o agente do usuário (navegador, dispositivo, etc.).

            $table->longText('payload');
            // Adiciona uma coluna `payload` para armazenar o conteúdo da sessão.

            $table->integer('last_activity')->index();
            // Adiciona uma coluna `last_activity` para armazenar o timestamp da última atividade na sessão.
            // A coluna possui um índice para otimizar buscas.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove as tabelas `users`, `password_reset_tokens`, e `sessions` caso a migração seja revertida.
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
