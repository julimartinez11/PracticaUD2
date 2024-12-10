<template>
  <div class="csv-manager">
    <h2 class="title">Administrador de Archivos CSV</h2>

    <!-- Inputs para el nombre y contenido del archivo -->
    <div class="input-section">
      <label for="filename" class="label">Nombre del archivo:</label>
      <input
          v-model="userInput"
          id="filename"
          class="input-field"
          placeholder="Introduce el nombre del archivo aquí..."
      />

      <label for="content" class="label">Contenido del archivo:</label>
      <textarea
          v-model="contentInput"
          id="content"
          class="textarea-field"
          rows="10"
          placeholder="Introduce el contenido en formato CSV..."
      ></textarea>
    </div>

    <!-- Botones para las operaciones -->
    <div class="button-container">
      <button @click="handleCsvGet" class="action-btn">Buscar</button>
      <button @click="handleCsvPost" class="action-btn">Crear</button>
      <button @click="handleCsvPut" class="action-btn">Actualizar</button>
      <button @click="handleCsvDelete" class="action-btn">Eliminar</button>
      <button @click="handleCsvList" class="action-btn">Listar</button>
    </div>

    <!-- Mensajes y resultados -->
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
  name: "CsvManager",
  data() {
    return {
      userInput: "", // Nombre del archivo ingresado
      contentInput: "", // Contenido del archivo ingresado
      apiResponse: null, // Respuesta de la API
      errorMessage: null, // Mensaje de error
    };
  },
  methods: {
    async handleCsvGet() {
      if (!this.userInput.trim()) {
        this.errorMessage = "Por favor, introduce el nombre del archivo.";
        return;
      }
      try {
        const response = await axios.get(
            `http://localhost:8000/api/csv/${this.userInput}`
        );
        if (response.data.contenido && response.data.contenido.length > 0) {
          this.apiResponse = response.data;
          this.errorMessage = null;

          const header = Object.keys(response.data.contenido[0]).join(",");
          const rows = response.data.contenido
              .map((row) => Object.values(row).join(","))
              .join("\n");
          this.contentInput = `${header}\n${rows}`;
        } else {
          this.apiResponse = response.data;
          this.contentInput = "";
          this.errorMessage =
              "El archivo está vacío o no tiene contenido legible.";
        }
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleCsvPost() {
      if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage =
            "Por favor, introduce el nombre del archivo y su contenido.";
        return;
      }
      try {
        const response = await axios.post("http://localhost:8000/api/csv", {
          filename: this.userInput,
          content: this.contentInput,
        });
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleCsvPut() {
      if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage =
            "Por favor, introduce el nombre del archivo y su contenido.";
        return;
      }

      const cleanedContent = this.contentInput.trim();
      if (!cleanedContent) {
        this.errorMessage = "El contenido del archivo no puede estar vacío.";
        return;
      }

      const rows = cleanedContent.split("\n");
      const headers = rows[0].split(",");

      for (let i = 1; i < rows.length; i++) {
        const columns = rows[i].split(",");
        if (columns.length !== headers.length) {
          this.errorMessage =
              "Todas las filas deben tener el mismo número de columnas que la cabecera.";
          return;
        }
      }

      try {
        const response = await axios.put(
            `http://localhost:8000/api/csv/${this.userInput}`,
            {
              content: cleanedContent,
            }
        );
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleCsvDelete() {
      if (!this.userInput.trim()) {
        this.errorMessage = "Por favor, introduce el nombre del archivo.";
        return;
      }

      try {
        const response = await axios.delete(
            `http://localhost:8000/api/csv/${this.userInput}`
        );
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    async handleCsvList() {
      try {
        const response = await axios.get("http://localhost:8000/api/csv");
        this.apiResponse = response.data;
        this.errorMessage = null;
      } catch (error) {
        this.handleApiError(error);
      }
    },
    handleApiError(error) {
      this.apiResponse = null;
      this.errorMessage =
          error.response?.data.mensaje || "Error al conectar con la API.";
    },
  },
};
</script>

<style>
.csv-manager {
  font-family: "Arial", sans-serif;
  padding: 20px;
  background-color: #f7f7f7;
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
  color: #444;
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

.button-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}

.action-btn {
  padding: 10px 15px;
  font-size: 14px;
  background-color: #007bff;
  color: white;
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
  background-color: white;
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
