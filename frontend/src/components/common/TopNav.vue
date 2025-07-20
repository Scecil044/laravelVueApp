<template>
  <nav
    class="flex items-center justify-between bg-white shadow px-6 py-3 h-16 sticky top-0 z-20"
  >
    <div class="flex items-center gap-2">
      <i class="pi pi-chart-bar text-primary text-2xl"></i>
      <span class="font-bold text-xl text-primary">My Dashboard</span>
    </div>
    <div class="flex items-center gap-4 relative">
      <button class="relative focus:outline-none">
        <i class="pi pi-bell text-xl text-gray-500 hover:text-primary"></i>
        <span
          class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1"
          >3</span
        >
      </button>
      <div class="relative">
        <img
          src="https://i.pravatar.cc/150?img=3"
          class="w-10 h-10 rounded-full border-2 border-primary-200 cursor-pointer"
          @click="toggleMenu"
        />
        <div
          v-if="menuOpen"
          class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-30"
        >
          <a
            href="#"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary-50"
            ><i class="pi pi-user mr-2"></i> Profile</a
          >
          <a
            href="#"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary-50"
            ><i class="pi pi-cog mr-2"></i> Settings</a
          >
          <div class="border-t my-1"></div>
          <a href="#"
            @click="handleLgout"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-primary-50"
            ><i class="pi pi-sign-out mr-2"></i> Logout</a
          >
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { RouterLink } from "vue-router";
import { useRouter } from "vue-router";
import { useUserStore } from "@/store/useUserStore";

const userStore = useUserStore();
const router = useRouter();
const menuOpen = ref(false);
const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};
const handleLgout = async () => {
  // Handle logout logic here
  menuOpen.value = false;
  await userStore.logout();
  router.push("/auth/login");
};
const handleClick = (e) => {
  if (!e.target.closest(".relative")) menuOpen.value = false;
};

onMounted(() => {
  window.addEventListener("click", handleClick);
});
onBeforeUnmount(() => {
  window.removeEventListener("click", handleClick);
});
</script>

<style scoped>
nav {
  z-index: 20;
}
</style>
