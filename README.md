# Blog Colaborativo - API Laravel

API REST para um blog colaborativo, construída com Laravel 12 e autenticação via Sanctum.

## Requisitos

- PHP >= 8.2
- Composer
- MySQL

## Instalacao

1. Clone o repositorio e instale as dependencias:

```bash
composer install
```

2. Copie o arquivo de ambiente e gere a chave da aplicacao:

```bash
cp .env.example .env
php artisan key:generate
```

3. Configure o banco de dados no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_colaborativo_laravel
DB_USERNAME=root
DB_PASSWORD=
```

4. Crie o banco de dados no MySQL:

```sql
CREATE DATABASE blog_colaborativo_laravel;
```

5. Execute as migrations:

```bash
php artisan migrate
```

6. Inicie o servidor:

```bash
php artisan serve
```

A API estara disponivel em `http://localhost:8000/api`.

## Endpoints

### Auth

| Metodo | Rota              | Descricao          | Auth |
|--------|-------------------|--------------------| ---- |
| POST   | `/api/auth/register` | Registrar usuario  | Nao  |
| POST   | `/api/auth/login`    | Login (retorna token) | Nao  |

### Posts

| Metodo | Rota              | Descricao          | Auth |
|--------|-------------------|--------------------| ---- |
| GET    | `/api/post`       | Listar todos os posts | Nao  |
| GET    | `/api/post/{id}`  | Buscar post por ID | Nao  |
| POST   | `/api/post`       | Criar post         | Sim  |
| PATCH  | `/api/post/{id}`  | Atualizar post     | Sim  |
| DELETE | `/api/post/{id}`  | Deletar post       | Sim  |

### Autenticacao

As rotas protegidas exigem o header `Authorization` com o token retornado no login:

```
Authorization: Bearer {token}
```

O token expira conforme configurado em `config/sanctum.php`.

## Estrutura do Banco

### users

| Campo      | Tipo         |
|------------|--------------|
| id         | bigint (PK)  |
| name       | varchar      |
| email      | varchar (unique) |
| password   | varchar      |
| created_at | timestamp    |
| updated_at | timestamp    |

### posts

| Campo      | Tipo         |
|------------|--------------|
| id         | bigint (PK)  |
| title      | varchar      |
| content    | text         |
| author_id  | bigint (FK -> users.id, cascade) |
| created_at | timestamp    |
| updated_at | timestamp    |
