<template>
  <div class="AppLayout min-h-screen flex bg-gray-50 dark:bg-dark-bg">
    <Sidebar :open="sidebarOpen" />
    <div class="flex-1 flex flex-col min-h-screen">
      <TopNav @toggle-sidebar="sidebarOpen = !sidebarOpen" />
      <main class="flex-1">
        <RouterView />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { RouterView } from "vue-router";
import Sidebar from '@/components/common/Sidebar.vue';
import TopNav from '@/components/common/TopNav.vue';

const sidebarOpen = ref(false);
</script>

<style scoped>
/* You can add layout-specific styles here */
</style>