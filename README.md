<h1>Estudos em Laravel</h1>

<h2>Estudos de 30 dias</h2>


<p>Estudos para a fixação definitiva de Laravel, com o objetivo de treinar e compreender Laravel-PHP de forma aprofundada e seguir com o desenvolvimento pessoal em full-stack. O próximo passo será JavaScript, focando em React.js, seguido pelos frameworks Next.js e Vite.</p>


# Laravel - Conceitos Básicos

Laravel é um framework PHP amplamente utilizado para desenvolvimento de aplicações web, conhecido por sua sintaxe expressiva e elegante.

---

## Instalação

Certifique-se de ter o Composer instalado antes de iniciar.

### Criando um Novo Projeto

```bash
# Instale o Laravel usando o Composer
composer create-project --prefer-dist laravel/laravel nome-do-projeto

# Entre no diretório do projeto
cd nome-do-projeto

# Inicie o servidor embutido do Laravel
php artisan serve
```

O servidor estará disponível em: `http://localhost:8000`.

---

## Estrutura de Pastas

- **app/**: Contém a lógica principal da aplicação (Models, Controllers, etc.).
- **config/**: Arquivos de configuração da aplicação.
- **database/**: Gerencia as migrações, factories e seeders.
- **routes/**: Define as rotas da aplicação.
- **resources/**: Contém views, arquivos de tradução e assets.
- **public/**: Diretório público acessível pelo navegador.

---

## Rotas

As rotas são definidas em `routes/web.php` para requisições web e `routes/api.php` para APIs.

### Exemplo de Rota Básica
```php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/saudacao/{nome}', function ($nome) {
    return "Olá, $nome!";
});
```

### Controladores

Você pode organizar suas rotas utilizando controladores.

```php
php artisan make:controller MeuController
```

Exemplo de uso no controlador:

```php
Route::get('/exemplo', [MeuController::class, 'metodoExemplo']);
```

---

## Controladores

Os controladores são responsáveis por gerenciar a lógica de requisições.

### Exemplo de Controlador Básico
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuController extends Controller
{
    public function metodoExemplo()
    {
        return "Olá do Controlador!";
    }
}
```

---

## Blade Templates

O Blade é o motor de templates do Laravel, que permite criar views dinâmicas.

### Exemplo de Template
Arquivo: `resources/views/saudacao.blade.php`

```blade
<!DOCTYPE html>
<html>
<head>
    <title>Sistema</title>
</head>
<body>
    <h1>Olá, {{ $nome }}!</h1>
</body>
</html>
```

### Passando Dados para a View

```php
Route::get('/saudacao/{nome}', function ($nome) {
    return view('saudacao', ['nome' => $nome]);
});
```

---

## Eloquent ORM

O Eloquent é o ORM (Object Relational Mapper) do Laravel para interagir com o banco de dados de forma simples.

### Criando um Model

```bash
php artisan make:model Produto -m
```

Isso cria o model `Produto` e a migração correspondente.

### Exemplo de Model
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco'];
}
```

### Migrações

Migrações definem a estrutura do banco de dados.

```php
Schema::create('produtos', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->decimal('preco', 8, 2);
    $table->timestamps();
});
```

Execute a migração:
```bash
php artisan migrate
```

---

## Exemplos de CRUD com Eloquent

### Inserir Dados
```php
Produto::create(['nome' => 'Notebook', 'preco' => 3500.00]);
```

### Listar Dados
```php
$produtos = Produto::all();
```

### Atualizar Dados
```php
$produto = Produto::find(1);
$produto->update(['preco' => 3600.00]);
```

### Deletar Dados
```php
Produto::destroy(1);
```

---

## Artisan

O Artisan é a interface de linha de comando do Laravel.

### Comandos Úteis
- `php artisan migrate`: Executa as migrações.
- `php artisan make:controller NomeController`: Cria um novo controlador.
- `php artisan route:list`: Lista todas as rotas registradas.
- `php artisan tinker`: Inicia um REPL interativo para testar comandos.

---

## Conclusão

Este README cobre os conceitos básicos de Laravel. Aprofundar-se nesses fundamentos é essencial para construir aplicações robustas e escaláveis.

Para mais informações, consulte a [documentação oficial do Laravel](https://laravel.com/docs).



# React.js - Conceitos Básicos

React.js é uma biblioteca JavaScript popular para construir interfaces de usuário. Desenvolvida pelo Facebook, ela é amplamente utilizada por sua eficiência, flexibilidade e abordagem declarativa.

---

## Instalação

Antes de começar, é necessário instalar o React. Certifique-se de ter o Node.js e o npm (ou yarn) instalados.

```bash
# Criação de um novo projeto React
npx create-react-app nome-do-projeto

# Entre na pasta do projeto
cd nome-do-projeto

# Inicie o servidor de desenvolvimento
npm start
```

---

## Estrutura Básica de um Componente

Um componente é a base de qualquer aplicação React. Pode ser uma **função** ou uma **classe**.

### Componente Funcional
```jsx
import React from 'react';

function ComponenteFuncional() {
  return (
    <div>
      <h1>Olá, React!</h1>
    </div>
  );
}

export default ComponenteFuncional;
```

### Componente de Classe
```jsx
import React, { Component } from 'react';

class ComponenteClasse extends Component {
  render() {
    return (
      <div>
        <h1>Olá, React com Classe!</h1>
      </div>
    );
  }
}

export default ComponenteClasse;
```

---

## JSX (JavaScript XML)

JSX é uma extensão de sintaxe que permite escrever HTML dentro do JavaScript.

### Exemplo de JSX
```jsx
const elemento = <h1>Bem-vindo ao React!</h1>;
```

### Regras do JSX
1. Todo elemento deve ser **fechado**.
2. Pode usar expressões JavaScript dentro de `{}`.
3. Um componente deve retornar apenas um elemento pai.

---

## Props (Propriedades)

As props permitem passar dados de um componente pai para um componente filho.

### Exemplo de Props
```jsx
function Saudacao(props) {
  return <h1>Olá, {props.nome}!</h1>;
}

export default function App() {
  return <Saudacao nome="João" />;
}
```

---

## State (Estado)

O estado permite que os componentes gerenciem dados dinâmicos e reativos.

### Exemplo de Uso de State em Classe
```jsx
import React, { Component } from 'react';

class Contador extends Component {
  constructor(props) {
    super(props);
    this.state = { contador: 0 };
  }

  incrementar = () => {
    this.setState({ contador: this.state.contador + 1 });
  };

  render() {
    return (
      <div>
        <p>Contador: {this.state.contador}</p>
        <button onClick={this.incrementar}>Incrementar</button>
      </div>
    );
  }
}

export default Contador;
```

### Exemplo de State em Componente Funcional com Hooks
```jsx
import React, { useState } from 'react';

function Contador() {
  const [contador, setContador] = useState(0);

  return (
    <div>
      <p>Contador: {contador}</p>
      <button onClick={() => setContador(contador + 1)}>Incrementar</button>
    </div>
  );
}

export default Contador;
```

---

## Ciclo de Vida dos Componentes

### Métodos do Ciclo de Vida em Componentes de Classe
1. **componentDidMount**: Executado após o componente ser montado.
2. **componentDidUpdate**: Executado após o componente ser atualizado.
3. **componentWillUnmount**: Executado antes de o componente ser desmontado.

```jsx
class ExemploCicloDeVida extends Component {
  componentDidMount() {
    console.log('Componente montado!');
  }

  componentDidUpdate() {
    console.log('Componente atualizado!');
  }

  componentWillUnmount() {
    console.log('Componente será desmontado!');
  }

  render() {
    return <div>Verifique o console para mensagens do ciclo de vida.</div>;
  }
}
```

---

## Hooks

Hooks permitem usar funcionalidades do React em componentes funcionais.

### Principais Hooks
1. **useState**: Gerencia o estado.
2. **useEffect**: Realiza efeitos colaterais.

### Exemplo de useEffect
```jsx
import React, { useState, useEffect } from 'react';

function Temporizador() {
  const [segundos, setSegundos] = useState(0);

  useEffect(() => {
    const intervalo = setInterval(() => {
      setSegundos(segundos => segundos + 1);
    }, 1000);

    return () => clearInterval(intervalo); // Limpeza
  }, []);

  return <p>Segundos: {segundos}</p>;
}

export default Temporizador;
```

---

## Conclusão

Este README aborda os conceitos básicos de React.js. Compreender esses fundamentos é o primeiro passo para construir aplicações modernas e dinâmicas com React.

Para mais informações, consulte a [documentação oficial do React](https://reactjs.org/).


# Aplicação Full Stack com Laravel e React.js

Este guia descreve como construir uma aplicação full stack utilizando **Laravel** no backend e **React.js** no frontend.

---

## Requisitos
- PHP >= 8.0
- Composer
- Node.js >= 16
- npm ou yarn
- Banco de dados configurado (MySQL, PostgreSQL, etc.)

---

## Configuração do Backend com Laravel

### Passo 1: Criar um Novo Projeto Laravel

```bash
composer create-project --prefer-dist laravel/laravel backend
cd backend
```

### Passo 2: Configurar o Banco de Dados
Edite o arquivo `.env` e configure as credenciais do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### Passo 3: Criar Model, Controller e Migração

Vamos criar uma API para gerenciar tarefas.

```bash
php artisan make:model Task -mcr
```

No arquivo de migração gerado em `database/migrations`, defina a estrutura da tabela:

```php
Schema::create('tasks', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->boolean('completed')->default(false);
    $table->timestamps();
});
```

Execute as migrações:

```bash
php artisan migrate
```

No controlador `TaskController`, adicione os métodos CRUD:

```php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
```

### Passo 4: Configurar Rotas da API

No arquivo `routes/api.php`:

```php
use App\Http\Controllers\TaskController;

Route::apiResource('tasks', TaskController::class);
```

Inicie o servidor do Laravel:

```bash
php artisan serve
```
A API estará disponível em: `http://localhost:8000/api/tasks`

---

## Configuração do Frontend com React.js

### Passo 1: Criar um Novo Projeto React

```bash
npx create-react-app frontend
cd frontend
```

### Passo 2: Instalar Axios

```bash
npm install axios
```

### Passo 3: Criar Serviço de API

Crie um arquivo `src/api.js`:

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
});

export default api;
```

### Passo 4: Construir o Componente Principal

No arquivo `src/App.js`:

```javascript
import React, { useState, useEffect } from 'react';
import api from './api';

function App() {
  const [tasks, setTasks] = useState([]);
  const [newTask, setNewTask] = useState('');

  useEffect(() => {
    api.get('/tasks').then((response) => setTasks(response.data));
  }, []);

  const addTask = () => {
    api.post('/tasks', { title: newTask, completed: false }).then((response) => {
      setTasks([...tasks, response.data]);
      setNewTask('');
    });
  };

  const toggleTask = (task) => {
    api.put(`/tasks/${task.id}`, { ...task, completed: !task.completed }).then((response) => {
      setTasks(tasks.map((t) => (t.id === task.id ? response.data : t)));
    });
  };

  const deleteTask = (id) => {
    api.delete(`/tasks/${id}`).then(() => {
      setTasks(tasks.filter((task) => task.id !== id));
    });
  };

  return (
    <div>
      <h1>Gerenciador de Tarefas</h1>
      <input
        type="text"
        value={newTask}
        onChange={(e) => setNewTask(e.target.value)}
      />
      <button onClick={addTask}>Adicionar Tarefa</button>
      <ul>
        {tasks.map((task) => (
          <li key={task.id}>
            <span
              style={{
                textDecoration: task.completed ? 'line-through' : 'none',
                cursor: 'pointer',
              }}
              onClick={() => toggleTask(task)}
            >
              {task.title}
            </span>
            <button onClick={() => deleteTask(task.id)}>Excluir</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default App;
```

### Passo 5: Iniciar o Servidor React

```bash
npm start
```

O frontend estará disponível em: `http://localhost:3000`

---
