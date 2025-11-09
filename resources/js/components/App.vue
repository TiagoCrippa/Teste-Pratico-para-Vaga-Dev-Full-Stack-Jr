<template>
  <div class="app">
    <h1>Cadastro de Usuários</h1>

    <!-- FORMULÁRIO -->
    <form @submit.prevent="saveUser" class="form">
      <input v-model="form.nome" type="text" placeholder="Nome" required />
      <input v-model="form.email" type="email" placeholder="E-mail" required />
      <input v-model="form.cep" type="text" placeholder="CEP" required />
      <button type="submit">{{ editMode ? "Atualizar" : "Cadastrar" }}</button>
      <button v-if="editMode" @click="cancelEdit" type="button" class="cancel">
        Cancelar
      </button>
    </form>

    <!-- LISTAGEM -->
    <div class="table-container" v-if="users.length">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.nome }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.cep }}</td>
            <td>{{ user.logradouro || user.endereco }}</td>
            <td>
              <button class="edit" @click="editUser(user)">Editar</button>
              <button class="delete" @click="deleteUser(user.id)">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <p v-else class="no-users">Nenhum usuário cadastrado.</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      users: [],
      form: { nome: "", email: "", cep: "" },
      editMode: false,
      editId: null,
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    async getUsers() {
      const res = await axios.get("/api/users");
      this.users = res.data;
    },
    async saveUser() {
      if (this.editMode) {
        await axios.put(`/api/users/${this.editId}`, this.form);
      } else {
        await axios.post("/api/users", this.form);
      }
      this.resetForm();
      this.getUsers();
    },
    async deleteUser(id) {
      if (confirm("Deseja realmente excluir este usuário?")) {
        await axios.delete(`/api/users/${id}`);
        this.getUsers();
      }
    },
    editUser(user) {
      this.form = { nome: user.nome, email: user.email, cep: user.cep };
      this.editId = user.id;
      this.editMode = true;
    },
    cancelEdit() {
      this.resetForm();
    },
    resetForm() {
      this.form = { nome: "", email: "", cep: "" };
      this.editId = null;
      this.editMode = false;
    },
  },
};
</script>

<style>

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: "Poppins", sans-serif;
  background: #1c1c1c; /* Cinza escuro de fundo */
  color: #222;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 20px;
  overflow: hidden; /* Remove qualquer barra de rolagem */
}

/* ======== CONTAINER PRINCIPAL ======== */
.app {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
  gap: 30px;
  width: 100%;
  max-width: 1100px;
  background: #2a2a2a; /* Leve contraste no card principal */
  border-radius: 12px;
  padding: 40px 50px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
  animation: fadeIn 0.5s ease-in-out;
}

/* ======== TÍTULO GERAL ======== */
h1 {
  width: 100%;
  text-align: center;
  margin-bottom: 30px;
  font-size: 2rem;
  color: #f4f4f4;
}

/* ======== FORMULÁRIO ======== */
.form {
  flex: 1;
  min-width: 300px;
  max-width: 350px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
  background: #dcdcdc; /* Cinza claro */
  border-radius: 10px;
  padding: 25px 20px;
  border: 1px solid #bcbcbc;
}

.form input {
  width: 100%;
  padding: 12px 15px;
  border-radius: 6px;
  border: 1px solid #bbb;
  background: #f5f5f5;
  color: #222;
  font-size: 0.95rem;
  outline: none;
  transition: border 0.3s, box-shadow 0.3s;
}

.form input:focus {
  border-color: #ffd000;
  box-shadow: 0 0 4px rgba(255, 208, 0, 0.4);
}

/* ======== BOTÕES GERAIS (Cadastrar / Atualizar / Cancelar) ======== */
button {
  background: linear-gradient(90deg, #ffcc00, #ffd84d); /* Degradê amarelo */
  border: none;
  padding: 12px 20px;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
  font-size: 0.95rem;
  color: #222;
  width: 100%;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(255, 208, 0, 0.4);
}

button.cancel {
  background: linear-gradient(90deg, #fff176, #ffee58);
}

button.cancel:hover {
  box-shadow: 0 4px 8px rgba(255, 238, 88, 0.4);
}

/* ======== TABELA ======== */
.table-container {
  flex: 2;
  min-width: 500px;
  background: #dcdcdc; /* Cinza claro */
  padding: 25px;
  border-radius: 10px;
  border: 1px solid #bcbcbc;
  overflow-x: hidden; /* Remove barra horizontal */
}

table {
  width: 100%;
  border-collapse: collapse;
  color: #333;
  text-align: center;
  font-size: 0.95rem;
}

th {
  background: #444; /* Cabeçalho cinza escuro */
  color: #f4f4f4;
  padding: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

td {
  padding: 12px 10px;
  border-bottom: 1px solid #bfbfbf;
  vertical-align: middle;
}

tr:hover td {
  background: #e8e8e8;
}

/* ======== BOTÕES DE AÇÃO ======== */
.edit,
.delete {
  border: none;
  border-radius: 6px;
  padding: 8px 14px;
  font-weight: 600;
  color: #fff;
  transition: transform 0.2s ease, opacity 0.2s ease;
}

.edit {
  background: #28a745; /* Verde */
}

.delete {
  background: #dc3545; /* Vermelho */
}

.edit:hover {
  transform: scale(1.05);
  opacity: 0.9;
}

.delete:hover {
  transform: scale(1.05);
  opacity: 0.9;
}

/* ======== TEXTO SEM USUÁRIOS ======== */
.no-users {
  flex: 2;
  text-align: center;
  font-size: 1rem;
  opacity: 0.7;
  margin-top: 20px;
  color: #eee;
}

/* ======== RESPONSIVIDADE ======== */
@media (max-width: 900px) {
  body {
    overflow-y: auto;
  }

  .app {
    flex-direction: column;
    align-items: center;
    padding: 30px 20px;
  }

  .form,
  .table-container {
    width: 100%;
    max-width: 600px;
  }

  h1 {
    font-size: 1.8rem;
  }
}

/* ======== ANIMAÇÃO ======== */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>
