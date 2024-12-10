<template>
  <div class="menu-container">
    <button
        v-for="option in options"
        :key="option.view"
        @click="$emit('menu-click', option.view)"
        class="menu-button"
    >
      {{ option.label }}
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      options: [
        { label: "Gestión de Archivos", view: "HelloApi" },
        { label: "Datos JSON", view: "JsonApi" },
        { label: "Archivos CSV", view: "CsvApi" },
      ],
    };
  },
};
</script>

<style>
.menu-container {
  padding: 10px;
  background-color: #f7f7f7;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.menu-button {
  display: block;
  width: 100%;
  margin: 8px 0;
  padding: 12px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  color: #ffffff;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.menu-button:hover {
  background-color: #0056b3;
}

.menu-button:active {
  background-color: #003f7f;
}
</style>
