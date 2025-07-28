<!-- TopNav.vue -->
<template>
  <header class="top-nav bg-white border-b border-gray-200 dark:bg-dark-bg dark:border-white/10">
    <div class="left">
      <button
        class="md:hidden text-gray-900 dark:text-white focus:outline-none"
        @click="$emit('toggle-sidebar')"
      >
        <i class="pi pi-bars text-xl"></i>
      </button>
      <span class="hidden md:block font-bold text-xl text-gray-900 dark:text-white">Dashboard</span>
    </div>

    <div class="right">
      <button class="icon-btn" @click="toggleDarkMode" :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'">
        <i v-if="isDark" class="pi pi-sun"></i>
        <i v-else class="pi pi-moon"></i>
      </button>
      <button class="icon-btn">
        <i class="pi pi-bell"></i>
        <span class="badge">3</span>
      </button>

      <div class="relative">
        <img
          src="https://i.pravatar.cc/150?img=3"
          class="avatar"
          @click="menuOpen = !menuOpen"
        />
        <Transition name="pop">
          <div v-if="menuOpen" class="dropdown bg-white border border-gray-200 shadow-lg text-gray-900 dark:bg-gray-800 dark:border-white/20 dark:shadow-xl dark:text-gray-200">
            <router-link :to="{ name: 'User', params: { id: userStore.user?._id } }"><i class="pi pi-user"></i> Profile</router-link>
            <a href="#"><i class="pi pi-cog"></i> Settings</a>
            <a href="#" @click="logout"><i class="pi pi-sign-out"></i> Logout</a>
          </div>
        </Transition>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/store/useUserStore';
import { useDarkMode } from '@/store/useDarkMode';

const userStore = useUserStore();
const router = useRouter();
const menuOpen = ref(false);

const { isDark, toggleDarkMode } = useDarkMode();

const logout = async () => {
  menuOpen.value = false;
  await userStore.logout();
  router.push('/auth/login');
};
</script>

<style scoped>
.top-nav {
  @apply flex items-center justify-between px-6 py-4 sticky top-0 z-20;
}
.left {
  @apply flex items-center gap-3;
}
.right {
  @apply flex items-center gap-4;
}
.icon-btn {
  @apply relative text-gray-900 dark:text-white text-xl;
}
.badge {
  @apply absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1;
}
.avatar {
  @apply w-10 h-10 rounded-full border-2 border-indigo-400 cursor-pointer;
}
.dropdown {
  @apply absolute right-0 mt-2 w-40 rounded-lg py-2 z-30;
}
.dropdown a, .dropdown .router-link-active, .dropdown .router-link-exact-active {
  @apply flex items-center gap-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 transition;
}
.pop-enter-active,
.pop-leave-active {
  transition: opacity 0.2s, transform 0.2s;
}
.pop-enter-from,
.pop-leave-to {
  opacity: 0;
  transform: scale(0.95);
}
</style>