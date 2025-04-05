
# 📇 Multi Contact Management

Uma aplicação web simples e direta para **gerenciar pessoas e seus contatos** de forma intuitiva. Crie, edite e visualize informações com um layout amigável, controle de autenticação e integração com dados reais de países.

---

## ✨ Funcionalidades

- 👤 CRUD de Pessoas (nome e email)
- 📞 CRUD de Contatos (código do país + número)
- 🌎 Consumo de API externa para lista de países
- 🔒 Autenticação com registro e login
- 🗃️ Exclusão lógica de pessoas (soft delete)
- 📊 Estatísticas de contatos por país
- 🧭 Navegação intuitiva com layout responsivo

---

## 🛠️ Tecnologias Utilizadas

| Categoria        | Ferramentas / Tecnologias                  |
|------------------|--------------------------------------------|
| Back-end         | PHP 8.1, Laravel 10                        |
| Front-end        | Blade + Bootstrap 5                       |
| Autenticação     | Laravel Breeze (ou implementação padrão)  |
| API Externa      | [REST Countries](https://restcountries.com) |
| Banco de Dados   | MariaDB                                   |
| Estilização extra| Select2, fontes via Bunny CDN             |
| Controle de versão | Git                                     |

---

## 🚀 Como rodar localmente

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-user/multi-contact-management.git
   cd multi-contact-management
   ```

2. Instale as dependências:
   ```bash
   composer install
   npm install && npm run dev
   ```

3. Copie o `.env` e configure:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure o banco de dados no `.env` e rode as migrations:
   ```bash
   php artisan migrate
   ```

5. Inicie o servidor:
   ```bash
   php artisan serve
   ```

Acesse em `http://localhost:8000`.

---

## 📌 Observações

- A exclusão de pessoas é feita via soft delete, preservando os dados no banco.

---

## 🧑‍💻 Autor

Desenvolvido com carinho por **Hudson Uchoa**  
Se quiser trocar uma ideia, é só chamar!

---
