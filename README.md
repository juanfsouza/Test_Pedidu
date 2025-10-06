# API de Loja - Teste Técnico

API REST para gerenciamento de produtos com integração ao IBGE, desenvolvida em Laravel com Clean Architecture.

<img width="1145" height="691" alt="Screenshot_4" src="https://github.com/user-attachments/assets/8b2737e6-3125-4767-bf37-50f040c18b07" />

<img width="1135" height="625" alt="Screenshot_5" src="https://github.com/user-attachments/assets/e273fe8a-6731-490f-8f48-6000b16a73f3" />

<img width="1129" height="599" alt="Screenshot_6" src="https://github.com/user-attachments/assets/50c2a6bc-78ca-4730-90c2-316f5e183f85" />

<img width="1175" height="592" alt="Screenshot_7" src="https://github.com/user-attachments/assets/ace67ac2-49b9-479e-9cd6-e52a1f4f1695" />

<img width="1149" height="576" alt="Screenshot_8" src="https://github.com/user-attachments/assets/3a549cc1-3a7f-46c1-ad3f-02a8157ade7c" />

### Instalação e executar

1. **Clone o repositório**
```bash
git clone https://github.com/juanfsouza/Test_Pedidu.git
cd test_tecnico
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**
Edite o arquivo `.env` com suas configurações de banco:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loja_api
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. **Execute as migrations**
```bash
php artisan migrate
```

6. **Inicie o servidor**
```bash
php artisan serve
```

A API estará disponível em `http://localhost:8000`

## 📋 Endpoints

### Produtos
- `GET /api/products` - Listar produtos
- `GET /api/products/{id}` - Buscar produto por ID
- `POST /api/products` - Criar produto
- `PUT /api/products/{id}` - Atualizar produto
- `DELETE /api/products/{id}` - Deletar produto

### IBGE
- `GET /api/ibge/cities` - Listar cidades do Rio de Janeiro (IBGE)

## 📝 Estrutura de Dados

### Produto
```json
{
  "name": "Nome do produto",
  "category": "Categoria",
  "status": "ACTIVE|INACTIVE",
  "quantity": 10
}
```

### Cidade (IBGE)
```json
{
  "id": 1,
  "ibge_id": 3300100,
  "ibge_name": "Angra dos Reis",
  "created_at": "2025-01-01T00:00:00.000000Z",
  "updated_at": "2025-01-01T00:00:00.000000Z"
}
```

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Executar testes específicos
php artisan test tests/Feature/ProductTest.php
```

## 🏗️ Arquitetura

O projeto utiliza **Clean Architecture** com as seguintes camadas:

- **Domain**: Entidades e regras de negócio
- **Application**: Use Cases e DTOs
- **Infrastructure**: Repositórios e APIs externas
- **Presentation**: Controllers e HTTP

## 📦 Tecnologias

- Laravel 12
- PHP 8.2+
- Clean Architecture
- DTOs (Data Transfer Objects)
- Repository Pattern
- Soft Delete
- Testes automatizados
