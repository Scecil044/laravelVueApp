<template>
  <div>
    <div class="w-full h-1 bg-brand"></div>
    <div class="AppLayout min-h-screen flex bg-gray-50 dark:bg-dark-bg">
      <div class="relative">
        <Sidebar
          :open="sidebarOpen"
          @request-logout="showLogoutModal = true"
        />
        <!-- Mobile overlay and close button -->
        <div v-if="sidebarOpen && isMobile" class="fixed inset-0 z-40 bg-black/40 md:hidden" @click="sidebarOpen = false"></div>
        <button v-if="sidebarOpen && isMobile" class="fixed top-4 left-64 z-50 md:hidden bg-white dark:bg-dark-bg rounded-full p-2 shadow border border-gray-200 dark:border-white/10" @click="sidebarOpen = false">
          <i class="pi pi-times text-xl text-gray-700 dark:text-gray-200"></i>
        </button>
      </div>
      <div class="flex-1 flex flex-col min-h-screen">
        <TopNav @toggle-sidebar="sidebarOpen = !sidebarOpen" />
        <main class="flex-1">
          <RouterView />
        </main>
      </div>
    </div>
    <ConfirmationModal
      :open="showLogoutModal"
      title="Logout Confirmation"
      message="Are you sure you want to logout? This action will end your session."
      confirmText="Logout"
      cancelText="Cancel"
      :danger="true"
      icon="pi pi-sign-out"
      @confirm="logout"
      @cancel="showLogoutModal = false"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import Sidebar from '@/components/common/Sidebar.vue';
import TopNav from '@/components/common/TopNav.vue';
import ConfirmationModal from '@/components/common/ConfirmationModal.vue';
import { RouterView } from 'vue-router';

const sidebarOpen = ref(false);
const showLogoutModal = ref(false);
const isMobile = ref(window.innerWidth < 768);

function logout() {
  showLogoutModal.value = false;
  // Implement your logout logic here
  alert('Logged out!');
}

function handleResize() {
  isMobile.value = window.innerWidth < 768;
}
onMounted(() => {
  window.addEventListener('resize', handleResize);
});
onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
});
</script>

<style scoped>
/* You can add layout-specific styles here */
</style>