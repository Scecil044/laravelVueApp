<!-- Sidebar.vue -->
<template>
  <aside
    :class="[
      'sidebar',
      open && 'open',
      'bg-white border-r border-gray-200 dark:bg-dark-bg dark:border-white/10'
    ]"
  >
    <div class="brand">
      <i class="pi pi-chart-bar text-3xl text-indigo-400"></i>
      <span class="font-bold text-xl text-gray-900 dark:text-white">My Dashboard</span>
    </div>

    <div class="profile">
      <img
        src="https://i.pravatar.cc/150?img=3"
        alt="User"
        class="avatar"
      />
      <span class="name text-gray-900 dark:text-white">John Doe</span>
      <span class="role text-gray-400">Admin</span>
    </div>

    <nav>
      <router-link to="/dashboard" class="nav-link" active-class="router-link-active">
        <i class="pi pi-home"></i> Dashboard
      </router-link>
      <router-link to="/users" class="nav-link" active-class="router-link-active">
        <i class="pi pi-users"></i> Users
      </router-link>
      <router-link to="/reports" class="nav-link" active-class="router-link-active">
        <i class="pi pi-chart-line"></i> Reports
      </router-link>
      <router-link to="/settings" class="nav-link" active-class="router-link-active">
        <i class="pi pi-cog"></i> Settings
      </router-link>
    </nav>
  </aside>
</template>

<script setup>
defineProps({ open: Boolean });
</script>

<style scoped>
.sidebar {
  @apply w-64 flex-shrink-0 flex flex-col py-6 px-5 fixed md:sticky top-0 h-screen z-30 transition-transform duration-300 -translate-x-full md:translate-x-0;
}
.sidebar.open {
  @apply translate-x-0;
}
.brand {
  @apply flex items-center gap-3 mb-8;
}
.profile {
  @apply flex flex-col items-center mb-10;
}
.avatar {
  @apply w-20 h-20 rounded-full border-4 border-indigo-400 mb-2;
}
.name {
  @apply font-semibold text-lg;
}
.role {
  @apply text-xs;
}
.nav-link {
  @apply flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition dark:text-gray-200 dark:hover:bg-white/10;
}
.router-link-active {
  @apply bg-indigo-100 text-indigo-600 shadow-lg shadow-indigo-500/10 dark:bg-indigo-500 dark:text-white dark:shadow-indigo-500/40;
}
</style>