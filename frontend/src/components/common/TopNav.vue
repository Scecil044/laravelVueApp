<!-- TopNav.vue -->
<template>
  <header class="top-nav">
    <div class="left">
      <button
        class="md:hidden text-white focus:outline-none"
        @click="$emit('toggle-sidebar')"
      >
        <i class="pi pi-bars text-xl"></i>
      </button>
      <span class="hidden md:block font-bold text-xl text-white">Dashboard</span>
    </div>

    <div class="right">
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
          <div v-if="menuOpen" class="dropdown">
            <router-link :to="{ name: 'User', params: { id: userStore.user?.id } }"><i class="pi pi-user"></i> Profile</router-link>
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

const userStore = useUserStore();
const router = useRouter();
const menuOpen = ref(false);

const logout = async () => {
  menuOpen.value = false;
  await userStore.logout();
  router.push('/auth/login');
};
</script>

<style scoped>
.top-nav {
  @apply flex items-center justify-between px-6 py-4 bg-black/30 backdrop-blur-md border-b border-white/10 sticky top-0 z-20;
}
.left {
  @apply flex items-center gap-3;
}
.right {
  @apply flex items-center gap-4;
}
.icon-btn {
  @apply relative text-white text-xl;
}
.badge {
  @apply absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1;
}
.avatar {
  @apply w-10 h-10 rounded-full border-2 border-indigo-400 cursor-pointer;
}
.dropdown {
  @apply absolute right-0 mt-2 w-40 bg-gray-800 border border-white/20 rounded-lg shadow-xl py-2 z-30;
}
.dropdown a {
  @apply flex items-center gap-2 px-4 py-2 text-gray-200 hover:bg-white/10 transition;
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