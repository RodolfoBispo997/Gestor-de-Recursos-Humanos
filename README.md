# Sistema de Gestão de RH

## Descrição

Sistema de Gestão de Recursos Humanos desenvolvido em Laravel 11. 
Permite a administração de colaboradores, criação de contas, e gerenciamento de dados de forma segura. 
Possui autenticação, autorização e CRUD completo para gerenciar os colaboradores.


## Funcionalidades

- Cadastro de administradores e colaboradores
- Diferenciação de acessos entre administrador e colaborador
- Autenticação via e-mail com Laravel Fortify
- CRUD completo (criar, atualizar, deletar) para colaboradores
- Menu dinâmico conforme o tipo de usuário
- Controle de permissões com Gates

4. Tecnologias utilizadas
## Tecnologias

- Laravel 11
- Blade (templates)
- Laravel Fortify (autenticação)
- PHP 8+
- MySQL

5. Requisitos
## Requisitos

- PHP >= 8.x
- Composer
- MySQL / MariaDB
- Node.js e NPM (para assets, caso use Laravel Mix)

6. Instalação

Explique como rodar o projeto:

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/RodolfoBispo997/Gestor-de-Recursos-Humanos.git
```
2. Entre na pasta do projeto:

``` 
cd seuprojeto
```

3. Instale as dependências:
```
composer install
```

4. Configure o .env com suas credenciais de banco:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

5. Gere a chave do Laravel:
```
php artisan key:generate
```
6. Rode as migrations:
```
php artisan migrate
```
7. Inicie o servidor:
```
php artisan serve
```
### 7. **Usuários padrão (opcional)**
```markdown
## Usuários padrão

- Administrador: admin@gmail.com / senha: 123456789



