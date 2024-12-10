<template>
  <div id="app" class="app-container">
    <div class="sidebar">
      <MainMenu @menu-click="currentView = $event" />
    </div>
    <div class="view-container">
      <component :is="currentView" />
    </div>
    <div class="output-section">
      <textarea readonly v-model="serverOutput" class="output-box"></textarea>
    </div>
  </div>
</template>

<script>
import MainMenu from "./components/MainMenu.vue";
import HelloApi from "./components/HelloApi.vue";
import JsonApi from "./components/JsonApi.vue";
import CsvApi from "./components/CsvApi.vue";

export default {
  components: {MainMenu, HelloApi, JsonApi, CsvApi},
  data() {
    return {
      currentView: "HelloApi", // Vista inicial
      serverOutput: "", // Salida del servidor
    };
  },
};
</script>

<style>
/* Contenedor principal */
.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f9f9f9;
  font-family: Arial, sans-serif;
}

/* Menú lateral */
.sidebar {
  width: 20%;
  background-color: #f1f1f1;
  border-right: 1px solid #ddd;
  padding: 15px;
  height: calc(100vh - 150px); /* Altura ajustada */
  overflow-y: auto;
  position: fixed;
}

/* Contenedor de la vista */
.view-container {
  margin-left: 20%;
  width: 75%;
  padding: 20px;
  background-color: #ffffff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

/* Sección de salida */
.output-section {
  margin-top: 20px;
  padding: 10px;
  background-color: #e9ecef;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Cuadro de salida del servidor */
.output-box {
  width: 100%;
  height: 120px;
  padding: 10px;
  font-size: 14px;
  font-family: "Courier New", Courier, monospace;
  border: 1px solid #ddd;
  border-radius: 5px;
  resize: none;
  background-color: #fdfdfd;
  color: #333;
}
</style>
