<script setup>
import TodoList from "./components/TodoList.vue";
import "./styles/global.css"
import AppLayout from "./components/AppLayout.vue";
</script>

<template>
  <div>
      <AppLayout>
          <TodoList/>
      </AppLayout>
  </div>

</template>

<style scoped>

</style>
