# Cadastro de Usuários (Vue.js)

Um sistema prático e funcional de **cadastro de usuários**, desenvolvido com **Vue.js 3** e **Axios**, que permite **criar, editar, excluir e listar** usuários de forma simples e eficiente.  

O design segue um estilo **moderno e minimalista**, utilizando **tons de cinza** e **botões em degradê amarelo**, oferecendo uma interface limpa, intuitiva e responsiva.

---

## Funcionalidades

- ✅ **Cadastrar** novos usuários  
- ✏️ **Editar** informações já cadastradas  
- ❌ **Excluir** usuários da lista  
- 📋 **Listar** todos os usuários com nome, e-mail, CEP e endereço  
- 🧹 **Cancelar edição** e limpar formulário  
- 🔄 **Atualização automática** da listagem após cada ação  

---

## Objetivo do Projeto

O propósito deste projeto é **demonstrar o domínio prático do desenvolvimento de aplicações CRUD** (Create, Read, Update, Delete) utilizando **Vue.js**.  

Além das operações básicas, o sistema também conta com uma **integração automática de endereço via CEP**, tornando o processo de cadastro mais ágil e realista — o usuário informa apenas o **CEP**, e o sistema busca automaticamente o **endereço correspondente** por meio de uma API.

---

## Tecnologias Utilizadas

- ⚙️ [Vue.js 3](https://vuejs.org/) — Framework JavaScript progressivo para interfaces reativas  
- 🌐 [Axios](https://axios-http.com/) — Cliente HTTP para integração com APIs  
- 🧩 [PHP 8+](https://www.php.net/) — Linguagem backend para manipulação de dados e persistência
- 💅 HTML5 + CSS3 — Estrutura e estilização base do projeto  
- 🧠 JavaScript (ES6+) — Lógica de manipulação e reatividade

---

## Instalação e Execução

### Pré-requisitos

Certifique-se de ter instalado:
- [Node.js](https://nodejs.org/) (versão 16 ou superior)
- [npm](https://www.npmjs.com/) ou [yarn](https://yarnpkg.com/)
- [PHP 8+](https://www.php.net/)
- Servidor local (ex: [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou [Laragon](https://laragon.org/))

---

### Passos para rodar o projeto

```bash
# 1️⃣ Clone o repositório
git clone https://github.com/seu-usuario/cadastro-usuarios.git

# 2️⃣ Acesse a pasta do projeto
cd cadastro-usuarios

# 3️⃣ Instale as dependências do frontend
npm install

# 4️⃣ Inicie o servidor do Vue.js
npm run dev

# 5️⃣ Inicie o servidor do PHP
php artisan serve

# 6️⃣ Acesse o site:
http://127.0.0.1:8000/