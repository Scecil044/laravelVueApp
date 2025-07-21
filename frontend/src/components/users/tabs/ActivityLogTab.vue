<template>
  <div class="space-y-6">
    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Activity Log</h3>
    <div v-if="logs.length === 0" class="text-gray-400 dark:text-gray-500">No activity yet.</div>
    <ul v-else class="space-y-3">
      <li v-for="log in logs" :key="log.id" class="flex items-start gap-3 p-3 bg-white dark:bg-white/5 rounded-lg shadow border border-gray-100 dark:border-white/10">
        <i class="pi pi-history text-brand text-xl mt-1"></i>
        <div class="flex-1 min-w-0">
          <div class="text-sm text-gray-900 dark:text-white">{{ log.action }}</div>
          <div class="text-xs text-gray-500 dark:text-gray-300 mt-1">By {{ log.by }} • {{ log.date }}</div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
const logs = [
  { id: 1, action: 'Updated salary from $4000 to $4500', by: 'HR Manager', date: '2023-03-01 10:15' },
  { id: 2, action: 'Uploaded new contract document', by: 'Jane Doe', date: '2023-02-20 14:22' },
  { id: 3, action: 'Changed status to Active', by: 'Admin', date: '2023-01-10 09:00' }
];
</script> 