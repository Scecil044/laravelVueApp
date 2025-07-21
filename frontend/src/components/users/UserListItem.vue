<template>
  <div @click="$emit('select', user)"
    :class="[
      'flex items-center gap-4 px-4 py-3 cursor-pointer hover:bg-brand/5 dark:hover:bg-brand/10 transition group border-b border-gray-100 dark:border-white/10',
      selected ? 'bg-brand/10 dark:bg-brand/20 border-l-4 border-brand' : ''
    ]">
    <img :src="user.avatar" class="w-12 h-12 rounded-full object-cover border-2 border-brand" />
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2">
        <span class="font-semibold text-gray-900 dark:text-white text-base text-nowrap">{{ user.name }}</span>
        <span v-if="user.status === 'Active'" class="ml-2 bg-brand text-white text-xs rounded-full px-2 py-0.5 font-bold">Active</span>
        <span v-else class="ml-2 bg-gray-400 text-white text-xs rounded-full px-2 py-0.5 font-bold">Inactive</span>
      </div>
      <div class="flex flex-wrap gap-2 text-xs text-gray-500 dark:text-gray-300 mt-1">
        <span>{{ user.jobTitle }}</span>
        <span v-if="user.department">• {{ user.department }}</span>
      </div>
    </div>
    <i class="pi pi-chevron-right text-gray-300 group-hover:text-brand text-lg"></i>
  </div>
</template>

<script setup>
const props = defineProps({
  user: Object,
  selected: Boolean
});
</script> 