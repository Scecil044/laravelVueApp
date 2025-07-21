<template>
  <div>
    <div class="w-full h-1 bg-brand"></div>
    <div class="AppLayout min-h-screen flex bg-gray-50 dark:bg-dark-bg">
      <Sidebar
        :open="sidebarOpen"
        @request-logout="showLogoutModal = true"
      />
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
import { ref } from 'vue';
import Sidebar from '@/components/common/Sidebar.vue';
import TopNav from '@/components/common/TopNav.vue';
import ConfirmationModal from '@/components/common/ConfirmationModal.vue';
import { RouterView } from 'vue-router';

const sidebarOpen = ref(false);
const showLogoutModal = ref(false);

function logout() {
  showLogoutModal.value = false;
  // Implement your logout logic here
  alert('Logged out!');
}
</script>

<style scoped>
/* You can add layout-specific styles here */
</style>