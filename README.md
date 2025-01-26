# O que é o Laravel?

Laravel é um framework PHP open-source, robusto e elegante, criado para facilitar o desenvolvimento de aplicações web modernas. Ele segue o padrão MVC (Model-View-Controller) e oferece um conjunto abrangente de recursos para simplificar tarefas comuns, como autenticação, roteamento, cache, e muito mais.

---

## Características Principais

### 1. **Facilidade de Uso**
Laravel tem uma sintaxe expressiva e intuitiva, tornando-o ideal tanto para iniciantes quanto para desenvolvedores experientes.

### 2. **Blade Template Engine**
Um mecanismo de templates simples e poderoso, que permite criar layouts dinâmicos com uma sintaxe limpa.

### 3. **Eloquent ORM**
Um Object-Relational Mapping (ORM) que torna a interação com o banco de dados intuitiva e fluida.

### 4. **Sistema de Roteamento**
Define rotas para a aplicação de maneira simples e flexível, com suporte para rotas nomeadas e controladores.

### 5. **Segurança Integrada**
Inclui proteções contra SQL Injection, Cross-Site Scripting (XSS), Cross-Site Request Forgery (CSRF), e mais.

### 6. **Sistema de Autenticação e Autorizacão**
Fornece soluções fáceis para implementar autenticação de usuários e controle de acesso baseado em funções e permissões.

### 7. **Suporte a Testes**
Ferramentas integradas para realizar testes unitários e de integração, garantindo maior confiabilidade da aplicação.

### 8. **Migrations e Seeders**
Facilita a criação e gestão de bancos de dados, com suporte para controle de versão e preenchimento de dados de teste.

---

## Requisitos do Sistema

- PHP >= 8.1
- Composer
- Banco de dados (MySQL, PostgreSQL, SQLite, ou SQL Server)
- Servidor web (Apache ou Nginx)

---

## Instalação

### 1. Requisitos
Certifique-se de que todos os requisitos do sistema estão instalados.

### 2. Instalar Laravel
Execute o comando abaixo para criar um novo projeto Laravel:

```bash
composer create-project --prefer-dist laravel/laravel nome-do-projeto
```

### 3. Configurar o Ambiente
Renomeie o arquivo `.env.example` para `.env` e configure as informações do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### 4. Gerar Chave da Aplicação
Execute o comando abaixo para gerar a chave da aplicação:

```bash
php artisan key:generate
```

### 5. Servir a Aplicação
Inicie o servidor local com:

```bash
php artisan serve
```
Acesse a aplicação no navegador em `http://127.0.0.1:8000`.

---

## Estrutura de Pastas

- **app/**: Contém os modelos, controladores, e serviços da aplicação.
- **config/**: Configurações da aplicação.
- **database/**: Migrations, Seeders e fábricas para o banco de dados.
- **resources/**: Views, assets estáticos e arquivos de tradução.
- **routes/**: Arquivos de definição de rotas.
- **storage/**: Arquivos gerados pela aplicação, como logs e uploads.
- **tests/**: Testes unitários e de integração.
- **vendor/**: Dependências gerenciadas pelo Composer.

---

## Comandos Úteis do Artisan

- **Iniciar o servidor local**:
  ```bash
  php artisan serve
  ```

- **Criar um controlador**:
  ```bash
  php artisan make:controller NomeDoController
  ```

- **Criar um modelo com migration**:
  ```bash
  php artisan make:model NomeDoModelo -m
  ```

- **Executar migrations**:
  ```bash
  php artisan migrate
  ```

- **Criar um seeder**:
  ```bash
  php artisan make:seeder NomeDoSeeder
  ```

- **Rodar seeders**:
  ```bash
  php artisan db:seed
  ```

- **Verificar rotas registradas**:
  ```bash
  php artisan route:list
  ```

---

## Recursos Adicionais

- [Documentação Oficial do Laravel](https://laravel.com/docs)
- [Comunidade Laravel no Discord](https://discord.com/invite/laravel)
- [Pacotes Populares no Laravel](https://packalyst.com/)

---



