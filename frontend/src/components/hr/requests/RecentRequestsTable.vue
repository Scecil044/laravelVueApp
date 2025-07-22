<template>
  <div>
    <div class="flex items-center justify-between mb-2">
      <h4 class="font-bold text-base text-gray-900 dark:text-white">Recent Requests</h4>
      <a href="#" class="text-brand text-xs font-semibold hover:underline">View All</a>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 dark:text-gray-300">
            <th class="py-2 pr-4">Name</th>
            <th class="py-2 pr-4">Type</th>
            <th class="py-2 pr-4">Date</th>
            <th class="py-2 pr-4">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="req in recentRequests" :key="req.id" class="border-b border-gray-100 dark:border-white/10">
            <td class="py-2 pr-4 dark:text-gray-200">{{ req.name }}</td>
            <td class="py-2 pr-4 dark:text-gray-200">{{ req.type }}</td>
            <td class="py-2 pr-4 dark:text-gray-200">{{ req.date }}</td>
            <td class="py-2 pr-4 dark:text-gray-200">
              <span :class="statusClass(req.status)">{{ req.status }}</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const recentRequests = [
  { id: 1, name: 'Jane Doe', type: 'Leave', date: '2024-06-21', status: 'Pending' },
  { id: 2, name: 'John Smith', type: 'WFH', date: '2024-06-20', status: 'Approved' },
  { id: 3, name: 'Mary Wambui', type: 'Training', date: '2024-06-19', status: 'Rejected' },
  { id: 4, name: 'Emily Davis', type: 'Leave', date: '2024-06-18', status: 'Pending' },
  { id: 5, name: 'Michael Chen', type: 'WFH', date: '2024-06-17', status: 'Approved' }
];
function statusClass(status) {
  if (status === 'Pending') return 'bg-brand/10 text-brand font-bold px-2 py-0.5 rounded-full text-xs';
  if (status === 'Approved') return 'bg-green-100 dark:bg-green-900 text-green-500 font-bold px-2 py-0.5 rounded-full text-xs';
  if (status === 'Rejected') return 'bg-red-100 dark:bg-red-900 text-red-500 font-bold px-2 py-0.5 rounded-full text-xs';
  return '';
}
</script> 