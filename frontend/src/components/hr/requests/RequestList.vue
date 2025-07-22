<template>
  <div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
      <input v-model="search" type="text" placeholder="Search requests..." class="w-full md:w-64 rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-white/10 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand transition" />
      <button class="ml-auto px-4 py-2 rounded-lg bg-brand text-white font-semibold shadow hover:bg-brand/80 transition text-sm flex items-center gap-2"><i class="pi pi-plus"></i> New Request</button>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 dark:text-gray-300">
            <th class="py-2 pr-4">Employee</th>
            <th class="py-2 pr-4">Type</th>
            <th class="py-2 pr-4">Date Range</th>
            <th class="py-2 pr-4">Reason</th>
            <th class="py-2 pr-4">Status</th>
            <th class="py-2 pr-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="req in filteredRequests" :key="req.id" class="border-b border-gray-100 dark:border-white/10 hover:bg-brand/5 dark:hover:bg-brand/10 transition">
            <td class="py-2 pr-4 font-semibold text-gray-900 dark:text-gray-200">{{ req.employee }}</td>
            <td class="py-2 pr-4 dark:text-gray-200">{{ req.type }}</td>
            <td class="py-2 pr-4 dark:text-gray-200">{{ req.from }} - {{ req.to }}</td>
            <td class="py-2 pr-4 dark:text-gray-200">{{ req.reason }}</td>
            <td class="py-2 pr-4 dark:text-gray-200"><span :class="statusClass(req.status)">{{ req.status }}</span></td>
            <td class="py-2 pr-4 dark:text-gray-200 flex gap-2">
              <button class="text-brand hover:underline"><i class="pi pi-eye"></i></button>
              <button class="text-gray-400 hover:text-brand"><i class="pi pi-pencil"></i></button>
              <button class="text-red-500 hover:text-red-700"><i class="pi pi-trash"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
const search = ref('');
const requests = ref([
  { id: 1, employee: 'Jane Doe', type: 'Leave', from: '2024-06-21', to: '2024-06-25', reason: 'Vacation', status: 'Pending' },
  { id: 2, employee: 'John Smith', type: 'WFH', from: '2024-06-20', to: '2024-06-20', reason: 'Personal', status: 'Approved' },
  { id: 3, employee: 'Mary Wambui', type: 'Training', from: '2024-06-19', to: '2024-06-20', reason: 'Skill upgrade', status: 'Rejected' },
  { id: 4, employee: 'Emily Davis', type: 'Leave', from: '2024-06-18', to: '2024-06-19', reason: 'Family', status: 'Pending' },
  { id: 5, employee: 'Michael Chen', type: 'WFH', from: '2024-06-17', to: '2024-06-17', reason: 'Doctor', status: 'Approved' }
]);
const filteredRequests = computed(() => {
  if (!search.value) return requests.value;
  return requests.value.filter(r =>
    r.employee.toLowerCase().includes(search.value.toLowerCase()) ||
    r.type.toLowerCase().includes(search.value.toLowerCase()) ||
    r.reason.toLowerCase().includes(search.value.toLowerCase())
  );
});
function statusClass(status) {
  if (status === 'Pending') return 'bg-brand/10 text-brand font-bold px-2 py-0.5 rounded-full text-xs';
  if (status === 'Approved') return 'bg-green-100 dark:bg-green-900 text-green-500 font-bold px-2 py-0.5 rounded-full text-xs';
  if (status === 'Rejected') return 'bg-red-100 dark:bg-red-900 text-red-500 font-bold px-2 py-0.5 rounded-full text-xs';
  return '';
}
</script> 