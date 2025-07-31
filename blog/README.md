
## Treino Laravel



## Criação de blog
- Blog: Recursos
    - post: 
    - User
    - tag


# 📝 Para que Serve um Blog?

Este repositório tem como objetivo explicar de forma clara e objetiva a importância e as múltiplas funções de um **blog** na internet, seja para uso pessoal, profissional ou comercial.

---

## 📌 O que é um Blog?

Um **blog** é uma plataforma digital onde conteúdos são publicados com frequência e organizados geralmente em ordem cronológica. É um meio de comunicação acessível, que permite a expressão de ideias, compartilhamento de conhecimento e aproximação com o público.

---

## 🎯 Principais Finalidades de um Blog

### 📚 Compartilhar Conhecimento ou Experiências
Ideal para quem deseja divulgar tutoriais, reflexões, histórias pessoais, experiências acadêmicas ou profissionais.

### 💼 Fortalecer Marca Pessoal ou Profissional
Blogs ajudam a construir autoridade em uma área específica e aumentar a visibilidade no mercado.

### 🛍️ Promover Produtos, Serviços ou Negócios
Usado no marketing de conteúdo para atrair visitantes e converter leads em clientes.

### 🗣️ Criar uma Comunidade ou Diálogo
Com a interação em comentários, leitores podem trocar ideias, opiniões e sugestões.

### 💡 Monetização
É possível ganhar dinheiro com blogs através de:
- Anúncios (Google AdSense)
- Posts patrocinados
- Produtos digitais
- Afiliados

---

## 🗂️ Tipos de Blog

| Tipo             | Descrição                                        |
|------------------|--------------------------------------------------|
| Pessoal          | Relatos de vida, opiniões, hobbies               |
| Educacional      | Aulas, conteúdos acadêmicos, dicas de estudo     |
| Profissional     | Portfólio, artigos técnicos, serviços            |
| Empresarial      | Relacionamento com clientes, marketing de marca |
| Nichado          | Moda, tecnologia, viagens, saúde, entre outros   |

---


# Criação de APIs Com Laravel

- planejamento de rotas
- Autenticação;
    - Registro;
        - Nome;
        - Email;
        - Senha.
        <p>Devolver um token de autenticação junto com os dados do usuário.</p>
    - Login;
    - Pagina de verificação;

---

###

---

# API de Autenticação com Laravel Sanctum

Esta API foi desenvolvida utilizando o framework **Laravel** com suporte ao **Laravel Sanctum** para autenticação via tokens. Abaixo estão os detalhes de cada rota e o funcionamento da lógica da aplicação.

##  Requisitos
- PHP 8.x
- Laravel 9.x ou superior
- Banco de dados configurado (ex: MySQL)
- Laravel Sanctum instalado e configurado

---

##  Funcionalidades da API

###  `GET /api/user`
**Descrição:** Retorna o usuário autenticado com base no token enviado.  
**Middleware:** `auth:sanctum`  
**Requer token de autenticação:**  
**Resposta:**
```json
{
  "id": 1,
  "name": "Usuário Exemplo",
  "email": "usuario@exemplo.com"
}
```

---

###  `POST /api/auth/signup`
**Descrição:** Registra um novo usuário no sistema.  
**Requer autenticação:**   
**Campos obrigatórios no `body`:**
```json
{
  "name": "Seu Nome",
  "email": "email@exemplo.com",
  "password": "senhaSegura",
  "password_confirmation": "senhaSegura"
}
```
**Validações:**
- `name`: obrigatório, string, máximo 255 caracteres
- `email`: obrigatório, formato de e-mail, único na tabela `users`
- `password`: obrigatório, mínimo de 8 caracteres, deve coincidir com a confirmação

**Resposta de sucesso:**
```json
{
  "user": {
    "id": 1,
    "name": "Seu Nome",
    "email": "email@exemplo.com"
  },
  "token": "token_gerado_pelo_sanctum"
}
```

---

###  `POST /api/auth/signin`
**Descrição:** Realiza o login de um usuário existente.  
**Requer autenticação:**  
**Campos obrigatórios no `body`:**
```json
{
  "email": "email@exemplo.com",
  "password": "senhaSegura"
}
```
**Validações:**
- `email`: obrigatório, formato de e-mail
- `password`: obrigatório, mínimo 6 caracteres

**Lógica:**
- Busca o usuário pelo e-mail
- Verifica se a senha é válida usando `Hash::check`
- Em caso de sucesso, retorna os dados do usuário e o token de autenticação

**Resposta de sucesso:**
```json
{
  "user": {
    "id": 1,
    "name": "Seu Nome",
    "email": "email@exemplo.com"
  },
  "token": "token_gerado_pelo_sanctum"
}
```

**Resposta de erro:**
```json
{
  "message": "Falha na autenticação"
}
```

---

##  Segurança
- A autenticação é gerenciada via tokens do **Laravel Sanctum**, que devem ser enviados no header:
```
Authorization: Bearer SEU_TOKEN
```
- As senhas são armazenadas de forma segura usando hashing (`bcrypt` via `Hash::make`)

---

##  Observações
- As rotas foram implementadas de forma inline no `routes/api.php`, ideal para protótipos ou APIs simples.
- Para produção, recomenda-se separar os controladores, usar `FormRequest` para validação, e incluir testes automatizados.

---

##  Estrutura Recomendada (Produção)
```
app/
├── Http/
│   ├── Controllers/
│   │   └── AuthController.php
│   ├── Requests/
│   │   ├── SignupRequest.php
│   │   └── SigninRequest.php
routes/
└── api.php
```

---


