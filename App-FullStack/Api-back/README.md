<h1>Estudos em Laravel</h1>

<h2>Estudos de 30 dias</h2>

<h3>Dia 1 - Domingo para Segunda</h3>

<p>Estudos para a fixação definitiva de Laravel, com o objetivo de treinar e compreender Laravel-PHP de forma aprofundada e seguir com o desenvolvimento pessoal em full-stack. O próximo passo será JavaScript, focando em React.js, seguido pelos frameworks Next.js e Vite.</p>


### Primeiro passo - criar um projeto em laravel e ajustar a Api.

``` bash
 php artisan install:api 
 ```

 # Rotas Registradas no Laravel

Este documento explica a listagem de rotas obtida através do comando `php artisan route:list` no Laravel. Cada linha corresponde a uma rota registrada na aplicação, com detalhes sobre os métodos HTTP aceitos, os endpoints e os controladores associados.

## Estrutura da Listagem

A saída do comando tem as seguintes colunas:

1. **Método** (`GET|HEAD`): Indica os métodos HTTP aceitos pela rota.
   - `GET`: Usado para obter recursos.
   - `HEAD`: Semelhante ao `GET`, mas retorna apenas os cabeçalhos da resposta sem o corpo.

2. **URI** (`/`, `api`, `sanctum/csrf-cookie`, etc.): O endpoint da rota.

3. **Nome da Rota**: Nome associado à rota (caso definido), usado para referência interna no código.

4. **Controlador e Método**: Indica qual controlador e método serão executados ao acessar a rota.

## Detalhamento das Rotas

### `GET|HEAD /`
- **Descrição**: Página inicial da aplicação, acessível pelo endpoint `/`.
- **Nome**: Não definido.
- **Controlador**: Não especificado (pode ser uma função anônima ou rota genérica).

### `GET|HEAD api`
- **Descrição**: Rota base para endpoints de API.
- **Nome**: Não definido.
- **Controlador**: Não especificado.

### `GET|HEAD sanctum/csrf-cookie`
- **Descrição**: Rota fornecida pelo Laravel Sanctum para gerar o cookie CSRF, necessário para proteger requisições autenticadas em APIs.
- **Nome**: `sanctum.csrf-cookie`
- **Controlador**: `Laravel\Sanctum\CsrfCookieController@show`

### `GET|HEAD storage/{path}`
- **Descrição**: Rota que permite o acesso a arquivos no diretório de armazenamento da aplicação.
- **Parâmetro**: `{path}` - Representa o caminho dinâmico para o arquivo.
- **Nome**: `storage.local`
- **Controlador**: Não especificado.

### `GET|HEAD up`
- **Descrição**: Rota personalizada que pode ser usada para verificar o status do sistema.
- **Nome**: Não definido.
- **Controlador**: Não especificado.

## Exemplo de Comando para Listar Rotas

```bash
php artisan route:list
```

Este comando exibe todas as rotas registradas na aplicação, incluindo as colunas de métodos, URIs, nomes de rotas e controladores associados.

## Observações
- Rotas sem nome ou controlador geralmente são definidas diretamente nos arquivos de rotas (`web.php` ou `api.php`).
- Caso precise adicionar ou modificar rotas, edite os arquivos mencionados ou utilize o comando `php artisan make:controller` para criar controladores.

# Comando `php artisan serve`

O comando `php artisan serve` é usado no Laravel para iniciar um servidor de desenvolvimento embutido, facilitando o processo de desenvolvimento de aplicações web. Este documento explica seu funcionamento, opções e uso.

## O que é?

`php artisan serve` utiliza o servidor embutido do PHP para fornecer uma maneira simples de testar e desenvolver aplicações Laravel sem a necessidade de configurar um servidor web completo, como Apache ou Nginx.

## Como usar?

### Sintaxe básica

```bash
php artisan serve
```

Ao executar este comando, o servidor será iniciado e estará disponível no endereço padrão:

```
http://127.0.0.1:8000
```

Você pode acessar sua aplicação Laravel diretamente no navegador através deste endereço.

## Opções Disponíveis

`php artisan serve` oferece algumas opções para personalizar seu uso:

### Alterar o Host
Por padrão, o servidor utiliza o endereço `127.0.0.1`. Você pode alterar isso com a opção `--host`:

```bash
php artisan serve --host=0.0.0.0
```

Isso permite que o servidor esteja acessível em toda a rede local.

### Alterar a Porta
A porta padrão utilizada é `8000`. Você pode alterá-la com a opção `--port`:

```bash
php artisan serve --port=8080
```

Com isso, o servidor estará disponível em `http://127.0.0.1:8080`.

### Combinação de Host e Porta
É possível combinar ambas as opções:

```bash
php artisan serve --host=0.0.0.0 --port=8080
```

O servidor estará disponível na rede local em `http://<IP-da-sua-máquina>:8080`.

## Uso Típico

1. **Iniciar o servidor**:
   ```bash
   php artisan serve
   ```
2. **Acessar no navegador**:
   Abra `http://127.0.0.1:8000` no navegador para visualizar sua aplicação.

3. **Encerrar o servidor**:
   Para parar o servidor, use `Ctrl+C` no terminal.

## Limitações

- **Produção**: Não use `php artisan serve` em ambientes de produção. Ele é destinado apenas para desenvolvimento.
- **Conexões simultâneas**: O servidor embutido não suporta muitas conexões simultâneas como servidores profissionais (Apache/Nginx).

## Mensagens Comuns

- **Endereço já em uso**: Se você receber um erro como:
  ```
  Address already in use
  ```
  Isso significa que a porta (ex.: 8000) já está sendo usada. Use a opção `--port` para especificar outra porta:
  ```bash
  php artisan serve --port=8081
  ```

## Conclusão

O comando `php artisan serve` é uma ferramenta poderosa e conveniente para o desenvolvimento local de aplicações Laravel. Ele permite configurar rapidamente um ambiente para testar sua aplicação. Para ambientes de produção, sempre configure um servidor dedicado como Nginx ou Apache.


# Comando `php artisan make:model`

O comando `php artisan make:model` é usado para criar uma nova classe de modelo Eloquent no Laravel. Esta funcionalidade automatiza a criação de classes relacionadas ao modelo, como migrações, seeders, controladores e outros recursos úteis.

---

## Descrição

```bash
php artisan make:model [opções] <nome>
```

- **Descrição**: Cria uma nova classe de modelo Eloquent.
- **Argumento Obrigatório**: 
  - `<name>`: O nome do modelo a ser criado.

---

## Opções

| Opção                  | Descrição                                                                                     |
|------------------------|-----------------------------------------------------------------------------------------------|
| `-a, --all`            | Gera migração, seeder, factory, policy, controlador resource e classes de form request.       |
| `-c, --controller`     | Cria um novo controlador para o modelo.                                                      |
| `-f, --factory`        | Cria uma nova factory para o modelo.                                                         |
| `--force`              | Cria a classe mesmo se o modelo já existir.                                                  |
| `-m, --migration`      | Cria um novo arquivo de migração para o modelo.                                              |
| `--morph-pivot`        | Indica que o modelo gerado deve ser uma tabela intermediária polimórfica personalizada.       |
| `--policy`             | Cria uma nova policy para o modelo.                                                          |
| `-s, --seed`           | Cria um novo seeder para o modelo.                                                           |
| `-p, --pivot`          | Indica que o modelo gerado deve ser uma tabela intermediária personalizada.                   |
| `-r, --resource`       | Indica que o controlador gerado deve ser um controlador de recurso.                          |
| `--api`                | Indica que o controlador gerado deve ser um controlador de recurso para APIs.                |
| `-R, --requests`       | Cria novas classes de form request e as utiliza no controlador de recurso.                   |
| `--test`               | Gera um teste acompanhando o modelo (com PHPUnit ou Pest).                                   |
| `--pest`               | Gera um teste utilizando Pest.                                                               |
| `--phpunit`            | Gera um teste utilizando PHPUnit.                                                            |
| `-h, --help`           | Exibe ajuda para o comando.                                                                  |
| `--silent`             | Não exibe nenhuma mensagem.                                                                  |
| `-q, --quiet`          | Exibe apenas erros. Suprime todas as outras saídas.                                          |
| `-V, --version`        | Exibe a versão da aplicação.                                                                 |
| `--ansi|--no-ansi`     | Força (ou desabilita com `--no-ansi`) saída ANSI.                                            |
| `-n, --no-interaction` | Não faz perguntas interativas.                                                               |
| `--env[=ENV]`          | Especifica o ambiente no qual o comando deve ser executado.                                  |
| `-v|vv|vvv, --verbose` | Aumenta o detalhamento das mensagens: 1 para saída normal, 2 para mais detalhes e 3 para debug.|

---

## Exemplos de Uso

### Criar um modelo básico
```bash
php artisan make:model Post
```

### Criar um modelo com migração e controlador
```bash
php artisan make:model Post -m -c
```

### Criar um modelo com migração, seeder, factory e policy
```bash
php artisan make:model Post -a
```

### Criar um modelo de tabela intermediária personalizada
```bash
php artisan make:model RoleUser --pivot
```

### Criar um modelo e um controlador API
```bash
php artisan make:model Product -c --api
```

---

## Observações

- As classes geradas são armazenadas automaticamente nos diretórios apropriados dentro do projeto Laravel.
- Sempre que usar o `--force`, tenha cuidado para evitar sobrescrever arquivos existentes.

---

Se precisar de mais informações, use o comando de ajuda:
```bash
php artisan make:model -h

# Explicação do Comando `php artisan make:model Post -a --api`

O comando abaixo é usado para criar um modelo no Laravel com várias classes associadas, incluindo recursos voltados para APIs:

```bash
php artisan make:model Post -a --api
```

## Detalhamento do Comando

1. **`php artisan make:model`**
   - Este comando é usado para criar uma nova classe de modelo Eloquent no Laravel.

2. **`Post`**
   - É o nome do modelo que será criado. Neste caso, o modelo será chamado `Post` e estará localizado no diretório `app/Models`.

3. **`-a` ou `--all`**
   - A opção `-a` (abreviação de `--all`) cria as seguintes classes automaticamente:
     - **Migration**: Arquivo de migração para criar a tabela correspondente no banco de dados.
     - **Seeder**: Classe para popular a tabela com dados iniciais.
     - **Factory**: Classe para gerar dados fictícios para testes.
     - **Policy**: Classe para gerenciar permissões de acesso ao modelo.
     - **Resource Controller**: Um controlador com métodos padrão para manipular o modelo.
     - **Form Request**: Classes para validar requisições ao controlador.

4. **`--api`**
   - Essa opção indica que o controlador gerado será um controlador de recurso voltado para APIs. Ele incluirá apenas métodos necessários para operações básicas, como:
     - `index` (listar recursos);
     - `store` (criar recursos);
     - `show` (exibir um recurso específico);
     - `update` (atualizar recursos);
     - `destroy` (remover recursos).

## Resultado

Ao executar esse comando, o Laravel gerará os seguintes arquivos automaticamente:

1. **Modelo `Post`**
   - Local: `app/Models/Post.php`
   - Representa a entidade "Post" na aplicação.

2. **Migração**
   - Local: `database/migrations/xxxx_xx_xx_xxxxxx_create_posts_table.php`
   - Arquivo para criar a tabela `posts` no banco de dados.

3. **Seeder**
   - Local: `database/seeders/PostSeeder.php`
   - Classe para adicionar dados iniciais à tabela `posts`.

4. **Factory**
   - Local: `database/factories/PostFactory.php`
   - Classe para gerar dados fictícios para o modelo `Post`.

5. **Policy**
   - Local: `app/Policies/PostPolicy.php`
   - Classe para gerenciar as regras de autorização relacionadas ao modelo `Post`.

6. **Controlador API**
   - Local: `app/Http/Controllers/PostController.php`
   - Controlador com métodos para manipular recursos de `Post`.

7. **Form Request**
   - Local: `app/Http/Requests/StorePostRequest.php` e `app/Http/Requests/UpdatePostRequest.php`
   - Classes para validar dados ao criar ou atualizar recursos `Post`.

## Exemplos de Uso

### Criar a tabela no banco de dados
Após gerar o modelo, aplique a migração para criar a tabela `posts`:

```bash
php artisan migrate
```

### Popular o banco de dados com dados fictícios
Execute o seeder para preencher a tabela com dados iniciais:

```bash
php artisan db:seed --class=PostSeeder
```

### Testar a API
Use ferramentas como **Postman** ou **cURL** para testar os endpoints gerados no controlador.

## Observação
- O controlador gerado com `--api` não inclui métodos como `create` e `edit`, pois são específicos para interfaces baseadas em views HTML.
- Esse comando é altamente eficiente para criar rapidamente estruturas completas para APIs no Laravel.


# Comando `php artisan migrate`

O comando `php artisan migrate` é utilizado no Laravel para executar as migrações pendentes e sincronizar o banco de dados com a estrutura definida nos arquivos de migração. As migrações são um recurso essencial no Laravel, permitindo gerenciar a estrutura do banco de dados de forma programática e versionada.

---

## O que são migrações?

Migrações no Laravel são classes PHP que definem as alterações na estrutura do banco de dados, como criação de tabelas, colunas e índices. Elas permitem:

- Adicionar ou remover tabelas e colunas.
- Definir chaves primárias e estrangeiras.
- Alterar a estrutura do banco de dados de maneira controlada.

Os arquivos de migração ficam localizados no diretório `database/migrations`.

---

## Uso do Comando

### Executar todas as migrações pendentes

```bash
php artisan migrate
```

Esse comando executa as migrações que ainda não foram aplicadas, criando ou alterando tabelas conforme especificado nos arquivos de migração.

### Especificar um ambiente

Você pode especificar o ambiente com a opção `--env`:

```bash
php artisan migrate --env=production
```

Isso garante que o comando seja executado no ambiente correto.

---

## Opções Disponíveis

| Opção                 | Descrição                                                                 |
|-----------------------|---------------------------------------------------------------------------|
| `--force`             | Executa as migrações em produção sem confirmação.                        |
| `--path`              | Executa apenas as migrações localizadas em um diretório específico.       |
| `--realpath`          | Informa ao comando para tratar o caminho fornecido como absoluto.         |
| `--pretend`           | Simula a execução das migrações e exibe as queries SQL correspondentes.   |
| `--seed`              | Executa os seeders após realizar as migrações.                           |
| `--step`              | Executa as migrações uma a uma, permitindo o rollback de cada etapa.     |

---

## Exemplos de Uso

### Migrar e popular o banco de dados

```bash
php artisan migrate --seed
```

Este comando aplica todas as migrações e executa os seeders para popular o banco de dados com dados iniciais.

### Migrar um diretório específico

```bash
php artisan migrate --path=database/migrations/custom
```

Executa apenas as migrações contidas no diretório `custom`.

### Simular a execução das migrações

```bash
php artisan migrate --pretend
```

Exibe as queries SQL que seriam executadas, sem aplicar as alterações no banco de dados.

### Forçar execução em produção

```bash
php artisan migrate --force
```

Útil para ambientes de produção, onde o comando normalmente exige confirmação para ser executado.

---

## Erros Comuns

1. **Erro de conexão com o banco de dados**:
   - Certifique-se de que o arquivo `.env` contém as configurações corretas de conexão.

2. **Tabela `migrations` não encontrada**:
   - Essa tabela é criada automaticamente na primeira migração. Certifique-se de que ela existe no banco de dados.

3. **Migrações já aplicadas**:
   - O comando não reaplica migrações já executadas. Para reaplicá-las, use `php artisan migrate:refresh`.

---

## Comandos Relacionados

- **Desfazer migrações**: 
  ```bash
  php artisan migrate:rollback
  ```
  Remove as últimas migrações aplicadas.

- **Refazer todas as migrações**:
  ```bash
  php artisan migrate:refresh
  ```
  Desfaz e reaplica todas as migrações.

- **Recriar o banco de dados**:
  ```bash
  php artisan migrate:fresh
  ```
  Remove todas as tabelas e executa todas as migrações do início.

---

## Conclusão

O comando `php artisan migrate` é essencial para gerenciar a estrutura do banco de dados no Laravel. Ele oferece flexibilidade e controle sobre alterações no esquema, permitindo um desenvolvimento mais organizado e colaborativo.



# Explicação das Rotas API no Laravel

Abaixo está uma explicação detalhada das rotas geradas para o controlador `PostController` e outras rotas adicionais padrão do Laravel:

---

## Rotas do `PostController`

### 1. **`GET|HEAD api/posts`**
   **Rota:** `/api/posts`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `posts.index` → `PostController@index`  
   **Descrição:** Retorna uma lista de todos os recursos de posts. O método `index` é usado para obter uma coleção de recursos.

### 2. **`POST api/posts`**
   **Rota:** `/api/posts`  
   **Método:** `POST`  
   **Ação:** `posts.store` → `PostController@store`  
   **Descrição:** Cria um novo post com os dados enviados na requisição. Geralmente usado para adicionar registros ao banco de dados.

### 3. **`GET|HEAD api/posts/{post}`**
   **Rota:** `/api/posts/{post}`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `posts.show` → `PostController@show`  
   **Descrição:** Retorna os detalhes de um post específico identificado pelo parâmetro `{post}`.

### 4. **`PUT|PATCH api/posts/{post}`**
   **Rota:** `/api/posts/{post}`  
   **Método:** `PUT` ou `PATCH`  
   **Ação:** `posts.update` → `PostController@update`  
   **Descrição:** Atualiza os dados de um post existente identificado pelo parâmetro `{post}`.

### 5. **`DELETE api/posts/{post}`**
   **Rota:** `/api/posts/{post}`  
   **Método:** `DELETE`  
   **Ação:** `posts.destroy` → `PostController@destroy`  
   **Descrição:** Remove um post específico identificado pelo parâmetro `{post}` do banco de dados.

---

## Outras Rotas

### 1. **`GET|HEAD sanctum/csrf-cookie`**
   **Rota:** `/sanctum/csrf-cookie`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `sanctum.csrf-cookie` → `Laravel\Sanctum\CsrfCookieController@show`  
   **Descrição:** Essa rota é usada pelo Laravel Sanctum para configurar um cookie CSRF seguro. Normalmente é usada para autenticação baseada em SPA (Single Page Applications).

### 2. **`GET|HEAD storage/{path}`**
   **Rota:** `/storage/{path}`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `storage.local`  
   **Descrição:** Essa rota é usada para servir arquivos armazenados localmente na pasta de armazenamento pública (`storage/app/public`).

### 3. **`GET|HEAD up`**
   **Rota:** `/up`  
   **Método:** `GET` ou `HEAD`  
   **Descrição:** Geralmente usada para verificar se a aplicação está online ou acessível. Pode ser uma rota personalizada ou parte de um pacote.

---

## Conclusão

Estas rotas representam operações padrão de CRUD (Create, Read, Update, Delete) para o modelo `Post`, bem como rotas auxiliares para autenticação e acesso a arquivos. Cada uma delas é definida de forma a atender às necessidades de uma API RESTful bem estruturada.


# Explicação das Rotas API no Laravel

Abaixo está uma explicação detalhada das rotas geradas para o controlador `PostController` e outras rotas adicionais padrão do Laravel:

---

## Rotas do `PostController`

### 1. **`GET|HEAD api/posts`**
   **Rota:** `/api/posts`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `posts.index` → `PostController@index`  
   **Descrição:** Retorna uma lista de todos os recursos de posts. O método `index` é usado para obter uma coleção de recursos.

### 2. **`POST api/posts`**
   **Rota:** `/api/posts`  
   **Método:** `POST`  
   **Ação:** `posts.store` → `PostController@store`  
   **Descrição:** Cria um novo post com os dados enviados na requisição. Geralmente usado para adicionar registros ao banco de dados.

### 3. **`GET|HEAD api/posts/{post}`**
   **Rota:** `/api/posts/{post}`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `posts.show` → `PostController@show`  
   **Descrição:** Retorna os detalhes de um post específico identificado pelo parâmetro `{post}`.

### 4. **`PUT|PATCH api/posts/{post}`**
   **Rota:** `/api/posts/{post}`  
   **Método:** `PUT` ou `PATCH`  
   **Ação:** `posts.update` → `PostController@update`  
   **Descrição:** Atualiza os dados de um post existente identificado pelo parâmetro `{post}`.

### 5. **`DELETE api/posts/{post}`**
   **Rota:** `/api/posts/{post}`  
   **Método:** `DELETE`  
   **Ação:** `posts.destroy` → `PostController@destroy`  
   **Descrição:** Remove um post específico identificado pelo parâmetro `{post}` do banco de dados.

---

## Outras Rotas

### 1. **`GET|HEAD sanctum/csrf-cookie`**
   **Rota:** `/sanctum/csrf-cookie`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `sanctum.csrf-cookie` → `Laravel\Sanctum\CsrfCookieController@show`  
   **Descrição:** Essa rota é usada pelo Laravel Sanctum para configurar um cookie CSRF seguro. Normalmente é usada para autenticação baseada em SPA (Single Page Applications).

### 2. **`GET|HEAD storage/{path}`**
   **Rota:** `/storage/{path}`  
   **Método:** `GET` ou `HEAD`  
   **Ação:** `storage.local`  
   **Descrição:** Essa rota é usada para servir arquivos armazenados localmente na pasta de armazenamento pública (`storage/app/public`).

### 3. **`GET|HEAD up`**
   **Rota:** `/up`  
   **Método:** `GET` ou `HEAD`  
   **Descrição:** Geralmente usada para verificar se a aplicação está online ou acessível. Pode ser uma rota personalizada ou parte de um pacote.

---

## Testando as Rotas com Insomnia

Abaixo está uma demonstração do uso da ferramenta **Insomnia** para testar a rota de criação de posts (`POST /api/posts`):


### Detalhes da Requisição
- **URL:** `http://127.0.0.1:8000/api/posts`
- **Método HTTP:** `POST`
- **Corpo da Requisição:**
  ```json
  {
      "title": "Post 1",
      "body": "this is the post body"
  }
  ```
- **Resposta Esperada:**
  ```json
  "ok"
  ```

---

## Conclusão

Estas rotas representam operações padrão de CRUD (Create, Read, Update, Delete) para o modelo `Post`, bem como rotas auxiliares para autenticação e acesso a arquivos. Cada uma delas é definida de forma a atender às necessidades de uma API RESTful bem estruturada.

# AuthController no Laravel

Este README explica como funciona o `AuthController` no Laravel, que gerencia a autenticação de usuários. Aqui abordaremos como criar e configurar o controlador de autenticação usando o comando `php artisan make:controller AuthController`, além de explicar as funcionalidades principais.

## Índice

1. [Introdução](#introdução)
2. [Criando o AuthController](#criando-o-authcontroller)
3. [Estrutura do AuthController](#estrutura-do-authcontroller)
4. [Registrando as Rotas](#registrando-as-rotas)
5. [Integração com o Sistema de Autenticação](#integração-com-o-sistema-de-autenticação)
6. [Conclusão](#conclusão)

---

## AuthController

No Laravel, a autenticação é facilmente configurável e personalizada. O comando `php artisan make:controller AuthController` permite criar um controlador que gerenciará as rotas e operações de autenticação, como login, registro e logout de usuários.

Este controlador será a base para qualquer personalização de fluxo de autenticação que você desejar implementar em sua aplicação.

## Criando o AuthController

Para criar o controlador de autenticação, execute o seguinte comando no terminal:

```bash
php artisan make:controller AuthController
