<template>
  <aside class="bg-white shadow h-full w-full md:w-64 flex flex-col py-6 px-4 min-h-screen">
    <div class="flex flex-col items-center mb-10">
      <i class="pi pi-chart-bar text-primary text-3xl mb-2"></i>
      <span class="font-bold text-xl text-primary mb-4">My Dashboard</span>
      <img src="https://i.pravatar.cc/150?img=3" class="rounded-full w-20 h-20 mb-2 border-4 border-primary-100" alt="User" />
      <span class="font-semibold text-lg">John Doe</span>
      <span class="text-xs text-gray-400">Admin</span>
    </div>
    <nav class="flex-1 w-full">
      <ul class="space-y-2">
        <li>
          <router-link to="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-primary-50 transition font-medium text-gray-700">
            <i class="pi pi-home text-lg"></i> Dashboard
          </router-link>
        </li>
        <li>
          <router-link to="/users" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-primary-50 transition font-medium text-gray-700">
            <i class="pi pi-users text-lg"></i> Users
          </router-link>
        </li>
        <li>
          <router-link to="/reports" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-primary-50 transition font-medium text-gray-700">
            <i class="pi pi-chart-line text-lg"></i> Reports
          </router-link>
        </li>
        <li>
          <router-link to="/settings" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-primary-50 transition font-medium text-gray-700">
            <i class="pi pi-cog text-lg"></i> Settings
          </router-link>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
// No longer using PanelMenu or Avatar components
</script>

<style scoped>
@media (max-width: 768px) {
  aside {
    position: fixed;
    z-index: 30;
    left: 0;
    top: 0;
    height: 100vh;
    width: 70vw;
    transform: translateX(-100%);
    transition: transform 0.3s;
  }
  aside.open {
    transform: translateX(0);
  }
}
</style>