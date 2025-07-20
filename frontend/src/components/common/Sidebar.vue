<!-- Sidebar.vue -->
<template>
  <aside
    :class="[
      'sidebar',
      open && 'open'
    ]"
  >
    <div class="brand">
      <i class="pi pi-chart-bar text-3xl text-indigo-400"></i>
      <span class="font-bold text-xl text-white">My Dashboard</span>
    </div>

    <div class="profile">
      <img
        src="https://i.pravatar.cc/150?img=3"
        alt="User"
        class="avatar"
      />
      <span class="name">John Doe</span>
      <span class="role">Admin</span>
    </div>

    <nav>
      <router-link to="/dashboard" class="nav-link">
        <i class="pi pi-home"></i> Dashboard
      </router-link>
      <router-link to="/users" class="nav-link">
        <i class="pi pi-users"></i> Users
      </router-link>
      <router-link to="/reports" class="nav-link">
        <i class="pi pi-chart-line"></i> Reports
      </router-link>
      <router-link to="/settings" class="nav-link">
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
  @apply bg-black/30 backdrop-blur-md border-r border-white/10 w-64 flex-shrink-0 flex flex-col py-6 px-5 fixed md:sticky top-0 h-screen z-30 transition-transform duration-300 -translate-x-full md:translate-x-0;
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
  @apply font-semibold text-white text-lg;
}
.role {
  @apply text-xs text-gray-400;
}
.nav-link {
  @apply flex items-center gap-3 px-4 py-3 rounded-lg text-gray-200 hover:bg-white/10 transition;
}
.router-link-active {
  @apply bg-indigo-500 text-white shadow-lg shadow-indigo-500/40;
}
</style>