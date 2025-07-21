<!-- Sidebar.vue -->
<template>
  <aside
    :class="[
      'w-64 flex-shrink-0 flex flex-col py-6 px-5 fixed md:sticky top-0 h-screen z-30 transition-transform duration-300 -translate-x-full md:translate-x-0',
      open && 'translate-x-0',
      'bg-white border-r border-gray-200 dark:bg-dark-bg dark:border-white/10'
    ]"
  >
    <div class="flex items-center gap-3 mb-10">
      <i class="pi pi-chart-bar text-3xl text-brand"></i>
      <span class="font-bold text-base text-gray-900 dark:text-white text-nowrap">My Dashboard</span>
    </div>

    <nav class="flex flex-col gap-2 flex-1">
      <template v-for="menu in adminMenus">
        <div v-if="menu.children" :key="menu.name">
          <button @click="toggleMenu(menu.name)" type="button"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 transition group relative font-medium w-full focus:outline-none"
            :class="{
              'bg-brand/10 dark:bg-brand/20 shadow-lg border-l-4 border-brand text-brand dark:text-brand': isMenuOpen(menu.name),
              'hover:bg-brand/5 dark:hover:bg-brand/10 hover:text-brand': !isMenuOpen(menu.name)
            }"
          >
            <i :class="[menu.icon, 'text-base', isMenuOpen(menu.name) ? 'text-brand' : 'text-gray-400 group-hover:text-brand transition']"></i>
            <span class="text-sm text-nowrap" >{{ menu.name }}</span>
            <i class="pi pi-chevron-down ml-auto transition-transform duration-200" :class="{ 'rotate-180': isMenuOpen(menu.name) }"></i>
          </button>
          <div v-if="isMenuOpen(menu.name)" class="pl-8 flex flex-col gap-1 mt-1">
            <router-link
              v-for="child in menu.children"
              :key="child.name"
              :to="child.to"
              class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 transition group font-medium"
              :class="{
                'bg-brand/10 dark:bg-brand/20 border-l-4 border-brand text-brand dark:text-brand': $route.path === child.to,
                'hover:bg-brand/5 dark:hover:bg-brand/10 hover:text-brand': $route.path !== child.to
              }"
            >
              <i :class="[child.icon, 'text-base', $route.path === child.to ? 'text-brand' : 'text-gray-400 group-hover:text-brand transition']"></i>
              <span class="text-sm text-nowrap">{{ child.name }}</span>
            </router-link>
          </div>
        </div>
        <router-link
          v-else
          :key="menu.to"
          :to="menu.to"
          class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 transition group relative font-medium"
          :class="{
            'bg-brand/10 dark:bg-brand/20 shadow-lg border-l-4 border-brand text-brand dark:text-brand': $route.path === menu.to,
            'hover:bg-brand/5 dark:hover:bg-brand/10 hover:text-brand': $route.path !== menu.to
          }"
        >
          <i :class="[menu.icon, 'text-base', $route.path === menu.to ? 'text-brand' : 'text-gray-400 group-hover:text-brand transition']"></i>
          <span class="text-sm text-nowrap">{{ menu.name }}</span>
        </router-link>
      </template>
    </nav>

    <button @click="$emit('request-logout')" class="mt-8 w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-brand text-white font-semibold shadow hover:bg-brand/80 transition text-sm text-nowrap">
      <i class="pi pi-sign-out text-lg"></i>
      Logout
    </button>
  </aside>
</template>

<script setup>
import { ref } from 'vue';
defineProps({ open: Boolean });
import {adminMenus} from "@/utils/constants.js"

const openMenus = ref([]);
function toggleMenu(name) {
  if (openMenus.value.includes(name)) {
    openMenus.value = openMenus.value.filter(n => n !== name);
  } else {
    openMenus.value.push(name);
  }
}
function isMenuOpen(name) {
  return openMenus.value.includes(name);
}
</script>