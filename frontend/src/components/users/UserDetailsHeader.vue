<template>
  <div v-if="user" class="flex flex-col md:flex-row items-center gap-4 md:gap-8 p-6 border-b border-gray-100 dark:border-white/10 bg-white/80 dark:bg-dark-bg/80">
    <img :src="user.avatar || 'https://i.pravatar.cc/150?img=1'" class="w-20 h-20 rounded-full object-cover border-4 border-brand shadow" />
    <div class="flex-1 min-w-0 text-center md:text-left">
      <div class="flex flex-col md:flex-row md:items-center gap-2">
        <span class="font-bold text-2xl text-gray-900 dark:text-white">{{ user.name || '-' }}</span>
        <span v-if="user.status === 'Active'" class="ml-2 bg-brand text-white text-xs rounded-full px-2 py-0.5 font-bold">Active</span>
        <span v-else class="ml-2 bg-gray-400 text-white text-xs rounded-full px-2 py-0.5 font-bold">Inactive</span>
      </div>
      <div class="text-sm text-gray-500 dark:text-gray-300 mt-1">{{ user.jobTitle || '-' }} <span v-if="user.department">• {{ user.department }}</span></div>
    </div>
    <button @click="$emit('edit')" class="mt-4 md:mt-0 px-6 py-2 rounded-lg bg-brand text-white font-semibold shadow hover:bg-brand/80 transition text-sm">Edit</button>
    
  </div>
  <div v-else class="p-6 text-center text-gray-400 dark:text-gray-500">No user selected.</div>
</template>

<script setup>
const props = defineProps({
  user: Object
});
</script> 