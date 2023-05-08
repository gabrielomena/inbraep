<div align="center">
	<img src="https://inbraep.com.br/wp-content/uploads/2017/10/cropped-favicon-192x192.png" with="600"/>
	<h1>FPF - Desafio FullStack</h1>
</div>

![Badge](https://img.shields.io/badge/Version-1.0.0-%23542F61?style=for-the-badge&logo=appveyor)
![Badge](https://img.shields.io/badge/React-%233570B2?style=for-the-badge&logo=react)

## 🛠 Ferramentas

-   [PHO7](https://pt-br.reactjs.org/)
-   [Vite](https://vitejs.dev/)
-   [VUEJS](https://nodejs.org/en/)


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

## ✅ Features Desenvolvidas

-   [x] API RESTful
-   [x] Listar tarefas
-   [x] Cadastrar tarefa
-   [x] Editar tarefa
-   [x] Excluir tarefa

