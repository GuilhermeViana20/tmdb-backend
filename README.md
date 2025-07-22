<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# TMDB Backend App

Este é um projeto de backend desenvolvido em Laravel que se conecta a um banco de dados MySQL. O projeto utiliza Docker e Docker Compose para facilitar a configuração e o gerenciamento do ambiente de desenvolvimento.

## Pré-requisitos

Antes de começar, você precisará ter instalado em sua máquina:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)

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

3. Configure as variáveis de ambiente no arquivo .env conforme necessário.

   ```bash
   cp .env.example .env
   ```

## Executando o Projeto

1. Para iniciar o projeto, execute o seguinte comando:

   ```bash
   docker-compose up -d --build
   ```

Isso irá construir as imagens e iniciar os containers definidos no arquivo docker-compose.yml.

## Acessando o Aplicativo

1. Após iniciar os containers, você pode acessar o aplicativo no seu navegador em:

   ```bash
   http://localhost:8080
   ```

## Acessando o Banco de Dados

1. Você pode acessar o banco de dados MySQL usando um cliente MySQL com as seguintes configurações:

- Host: localhost
- Porta: 3306
- Usuário: root
- Senha: root
- Banco de Dados: laravel
