<template>
  <div id="app" class="app-container">
    <div class="sidebar">
      <MainMenu @menu-click="currentView = $event" />
    </div>
    <div class="view-container">
      <component :is="currentView" />
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

.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f9f9f9;
  font-family: Arial, sans-serif;
}


.sidebar {
  width: 20%;
  background-color: #f1f1f1;
  border-right: 1px solid #ddd;
  padding: 15px;
  height: calc(100vh - 150px); /* Altura ajustada */
  overflow-y: auto;
  position: fixed;
}


.view-container {
  margin-left: 20%;
  width: 75%;
  padding: 20px;
  background-color: #ffffff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}


</style>
