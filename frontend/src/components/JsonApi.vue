<template>
  <div class="json-manager">
    <h2 class="title">Gestión de Datos JSON</h2>

    <div class="input-section">
      <label for="id" class="label">ID del JSON:</label>
      <input
          v-model="userInput"
          id="id"
          class="input-field"
          placeholder="Introduce el ID aquí"
      />

      <label for="content" class="label">Contenido:</label>
      <textarea
          v-model="contentInput"
          id="content"
          class="textarea-field"
          rows="10"
          placeholder="Introduce el contenido JSON aquí"
      ></textarea>
    </div>

    <div class="action-buttons">
      <button @click="handleJsonGet" class="action-btn">Buscar</button>
      <button @click="handleJsonPost" class="action-btn">Crear</button>
      <button @click="handleJsonPut" class="action-btn">Actualizar</button>
      <button @click="handleJsonDelete" class="action-btn">Eliminar</button>
      <button @click="handleJsonList" class="action-btn">Listar</button>
    </div>

    <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
    <div v-if="apiResponse" class="response-container">
      <h3 class="response-title">Respuesta del Servidor</h3>
      <pre class="response-content">{{ apiResponse }}</pre>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "JsonManager",
  data() {
    return {
      userInput: "",
      contentInput: "",
      apiResponse: null,
      errorMessage: null,
    };
  },
  methods: {
    async handleJsonGet() {
      if (!this.userInput.trim()) {
        this.errorMessage = "Por favor, introduce un ID válido.";
        return;
      }
      try {
        const response = await axios.get(
            `http://localhost:8000/api/json/${this.userInput}`
        );
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleJsonPost() {
      if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage =
            "Por favor, introduce el ID y el contenido JSON.";
        return;
      }
      try {
        const contentObject = JSON.parse(this.contentInput);
        const response = await axios.post("http://localhost:8000/api/json", {
          filename: this.userInput,
          content: contentObject,
        });
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.errorMessage = "Formato JSON no válido.";
      }
    },
    async handleJsonPut() {
      if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage =
            "Por favor, introduce el ID y el contenido JSON.";
        return;
      }
      try {
        const contentObject = JSON.parse(this.contentInput);
        const response = await axios.put(
            `http://localhost:8000/api/json/${this.userInput}`,
            {
              content: contentObject,
            }
        );
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.errorMessage = "Formato JSON no válido.";
      }
    },
    async handleJsonDelete() {
      if (!this.userInput.trim()) {
        this.errorMessage = "Por favor, introduce un ID válido.";
        return;
      }
      try {
        const response = await axios.delete(
            `http://localhost:8000/api/json/${this.userInput}`
        );
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleJsonList() {
      try {
        const response = await axios.get("http://localhost:8000/api/json");
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    handleApiError(error) {
      this.apiResponse = null;
      this.errorMessage =
          error.response?.data || error.message || "Ocurrió un error.";
    },
  },
};
</script>

<style>
.json-manager {
  font-family: "Arial", sans-serif;
  padding: 20px;
  background-color: #f9f9f9;
}

.title {
  text-align: center;
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

.input-section {
  margin-bottom: 20px;
}

.label {
  display: block;
  margin-bottom: 5px;
  font-size: 16px;
  color: #555;
}

.input-field,
.textarea-field {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.textarea-field {
  resize: none;
}

.action-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}

.action-btn {
  padding: 10px 20px;
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
  color: #d9534f;
  font-weight: bold;
  margin-top: 10px;
}

.response-container {
  margin-top: 20px;
  padding: 15px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.response-title {
  font-size: 18px;
  margin-bottom: 10px;
  font-weight: bold;
}

.response-content {
  font-size: 14px;
  white-space: pre-wrap;
  word-wrap: break-word;
}
</style>
