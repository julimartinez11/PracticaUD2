<template>
  <div class="file-manager">
    <h2 class="title">Storage Files</h2>

    <div class="input-section">
      <label for="filename" class="label">Nombre del archivo:</label>
      <input v-model="userInput" id="filename" placeholder="Escribe el nombre del archivo aquí..." class="input-field" />

      <label for="content" class="label">Contenido:</label>
      <textarea v-model="contentInput" id="content" rows="10" placeholder="Introduce el contenido del archivo..." class="textarea-field"></textarea>
    </div>

    <div class="action-buttons">
      <button @click="handleHelloGet" class="action-btn">Buscar</button>
      <button @click="handleHelloPost" class="action-btn">Crear</button>
      <button @click="handleHelloPut" class="action-btn">Actualizar</button>
      <button @click="handleHelloDelete" class="action-btn">Eliminar</button>
      <button @click="handleHelloList" class="action-btn">Listar</button>
    </div>

    <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
    <div v-if="apiResponse" class="response-container">
      <h3 class="response-title">Respuesta del servidor:</h3>
      <pre class="response-content">{{ apiResponse }}</pre>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'FileManager',
  data() {
    return {
      userInput: '',
      contentInput: '',
      apiResponse: null,
      errorMessage: null
    };
  },
  methods: {
    async handleHelloGet() {
      if (!this.userInput.trim()) {
        this.errorMessage = 'Por favor, introduce un nombre de archivo válido.';
        return;
      }
      try {
        const response = await axios.get(`http://localhost:8000/api/hello/${this.userInput}`);
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleHelloPost() {
      if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage = 'Por favor, introduce el nombre del archivo y el contenido.';
        return;
      }
      try {
        const response = await axios.post('http://localhost:8000/api/hello', {
          filename: this.userInput,
          content: this.contentInput
        });
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleHelloPut() {
      if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage = 'Por favor, introduce el nombre del archivo y el contenido.';
        return;
      }
      try {
        const response = await axios.put(`http://localhost:8000/api/hello/${this.userInput}`, {
          content: this.contentInput
        });
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleHelloDelete() {
      if (!this.userInput.trim()) {
        this.errorMessage = 'Por favor, introduce un nombre de archivo válido.';
        return;
      }
      try {
        const response = await axios.delete(`http://localhost:8000/api/hello/${this.userInput}`);
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleHelloList() {
      try {
        const response = await axios.get('http://localhost:8000/api/hello');
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    handleApiError(error) {
      this.apiResponse = null;
      this.errorMessage = error.response?.data || error.message || 'Ocurrió un error.';
    }
  }
};
</script>

<style>
.file-manager {
  font-family: 'Arial', sans-serif;
  padding: 20px;
}

.title {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 20px;
  text-align: center;
  color: #333;
}

.input-section {
  margin-bottom: 20px;
}

.label {
  font-size: 16px;
  margin-bottom: 5px;
  display: block;
  color: #555;
}

.input-field,
.textarea-field {
  width: 100%;
  padding: 10px;
  font-size: 14px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.textarea-field {
  resize: none;
}

.action-buttons {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.action-btn {
  padding: 10px 15px;
  font-size: 14px;
  background-color: #007BFF;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.action-btn:hover {
  background-color: #0056b3;
}

.error-message {
  color: #D9534F;
  font-weight: bold;
}

.response-container {
  margin-top: 20px;
  padding: 15px;
  background-color: #F9F9F9;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.response-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.response-content {
  font-size: 14px;
  white-space: pre-wrap;
}
</style>
