<div align="center">
	<img src="https://inbraep.com.br/wp-content/uploads/2017/10/cropped-favicon-192x192.png" with="600"/>
	<h1>INBRAEP - Desafio FullStack</h1>
</div>

![Badge](https://img.shields.io/badge/Version-1.0.0-%23542F61?style=for-the-badge&logo=appveyor)
![Badge](https://img.shields.io/badge/Laravel-v10.00-%233570B2?style=for-the-badge&logo=laravel)
![Badge](https://img.shields.io/badge/PHP-v^7.4-%2300B98E?style=for-the-badge&logo=php)
![Badge](https://img.shields.io/badge/Composer-v2.1.9-%2300B98E?style=for-the-badge&logo=appveyor)

## 🛠 Ferramentas

-   [Laravel](https://laravel.com/docs/10.x)
-   [Vite](https://vitejs.dev/)
-   [VUEJS](https://vuejs.org/)


## 💻 Padronização de código

-   [Eslint](https://eslint.org/)
-   [Prettier](https://prettier.io/)

## 📦 Requisitos para rodar o sistema

-   [PHP7]
-   [YARN / NPM]
-   [MYSQL]
-   [COMPOSER]

## 🚀 Executando o projeto
### 1. Abra o terminal e clone o projeto para sua máquina
```bash
git clone https://github.com/gabrielomena/inbraep
```
### 2. BACKEND
#### 2.1 Acesse o projeto backend
```bash
cd inbraep/backend
```
### 2.1 Baixe as dependências com composer
```bash
composer install
```
#### 2.2 Copie o .env-example para .env
```bash
cp .env-example .env
```
#### 2.3 Edite conforme suas configurações do banco de dados Mysql
```bash
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=inbraep
DB_USERNAME=
DB_PASSWORD=
```
#### 2.4 Gere uma chave de criptografia para o código
```bash
php artisan key:generate
```
#### 2.5 Crie o banco no seu mysql

#### 2.6 Execute as migrations
```bash
php artisan migrate
```
### 3. FRONTEND
#### 3.1 Volte para a pasta do projeto clonado inbraep e acesse a pasta do frontend
```bash
cd frontend
```
#### 3.2 Instale as dependências
```bash
yarn 
```
ou 
```bash
npm install
```
#### 3.3 Acesse o arquivo axios.js na pasta config e altere a baseUrl de acordo com o endereço do servidor backend
```bash
cd src/config 
```
```bash
const api = axios.create({
    baseURL: "https://backend.inbraep/api/",
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
});
```
#### 3.4 volte para a pasta frontend e start o projeto
```bash
yarn dev
```
ou 
```bash
npm run dev
```
## CASO PREFIRA PODE ACESSAR O SISTEMA EM PRODUÇÃO:
[CLIQUE AQUI PARA VISUALIZAR EM PRODUÇÃO](https://inbraep.gabrielomena.com.br/)

## ✅ Features Desenvolvidas

-   [x] API RESTful
-   [x] Listar tarefas
-   [x] Cadastrar tarefa
-   [x] Editar tarefa
-   [x] Excluir tarefa

