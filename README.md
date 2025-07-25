<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# TMDB Backend App

Este é um projeto de backend desenvolvido em Laravel que se conecta a um banco de dados MySQL.  
O projeto utiliza Docker e Docker Compose para facilitar a configuração e o gerenciamento do ambiente de desenvolvimento.

---

## Pré-requisitos

Antes de começar, você precisará ter instalado em sua máquina:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)

---

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/GuilhermeViana20/tmdb-backend.git
   cd tmdb-backend
   ```

2. Crie um arquivo .env a partir do arquivo .env.example:

   ```bash
   cp .env.example .env
   ```

4. Suba os containers com Docker Compose:

   ```bash
   docker-compose up -d --build
   ```

5. Acesse o container do app e instale as dependências:

   ```bash
   docker exec -it tmdb-backend-app bash
   composer install
   php artisan key:generate
   ```

6. Rode as migrations:

   ```bash
   php artisan migrate
   ```

## Como obter a chave da API do TMDB

1. Crie uma conta gratuita no **[TMDB](https://www.themoviedb.org/)**.
2. Faça login e vá até as **configurações da conta**.
3. No menu lateral, clique em **API**.
4. Solicite uma nova chave de **API.
5. Aceite os **termos e condições**.
6. Aguarde a aprovação (pode levar algum tempo).
7. Após a aprovação, copie a chave e adicione no seu arquivo .env:

   ```bash
   TMDB_BEARER_TOKEN=coloque_a_chave_aqui
   ```

## Estrutura do Projeto

O projeto segue a seguinte estrutura:

    app/
    ├── Http/
    │   ├── Controllers/
    │   │   ├── Api/
    │   │   └── Controller.php
    │   └── Middleware/
    ├── Models/
    ├── Providers/
    ├── Repositories/
    ├── Services/

- Controllers: camadas de entrada da API
- Repositories: acesso aos dados (DB)
- Services: regras de negócio

---

## Scripts úteis

- Subir containers: docker-compose up -d
- Parar containers: docker-compose down
- Acessar container: docker exec -it tmdb-backend-app bash
- Rodar migrations: php artisan migrate

