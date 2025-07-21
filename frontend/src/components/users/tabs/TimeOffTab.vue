<template>
  <div class="space-y-8 pl-5">
    <div>
      <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Leave Balances</h3>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div v-for="leave in leaveBalances" :key="leave.type" class="bg-brand/10 dark:bg-brand/20 rounded-lg p-4 text-center">
          <div class="font-bold text-brand text-xl">{{ leave.balance }}</div>
          <div class="text-xs text-gray-700 dark:text-gray-200 mt-1">{{ leave.type }}</div>
        </div>
      </div>
    </div>
    <div>
      <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Time-off History</h3>
      <div v-if="history.length === 0" class="text-gray-400 dark:text-gray-500">No time-off history.</div>
      <div v-else class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-gray-500 dark:text-gray-300">
              <th class="py-2 pr-4">Type</th>
              <th class="py-2 pr-4">From</th>
              <th class="py-2 pr-4">To</th>
              <th class="py-2 pr-4">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in history" :key="item.id" class="border-b border-gray-100 dark:border-white/10">
              <td class="py-2 pr-4">{{ item.type }}</td>
              <td class="py-2 pr-4">{{ item.from }}</td>
              <td class="py-2 pr-4">{{ item.to }}</td>
              <td class="py-2 pr-4">
                <span :class="item.status === 'Approved' ? 'text-green-500' : item.status === 'Pending' ? 'text-brand' : 'text-red-500'">{{ item.status }}</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div>
      <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Pending Requests</h3>
      <div v-if="pending.length === 0" class="text-gray-400 dark:text-gray-500">No pending requests.</div>
      <ul v-else class="space-y-2">
        <li v-for="req in pending" :key="req.id" class="flex items-center gap-3 p-3 bg-white dark:bg-white/5 rounded-lg shadow border border-gray-100 dark:border-white/10">
          <span class="font-semibold text-gray-900 dark:text-white">{{ req.type }}</span>
          <span class="text-xs text-gray-500 dark:text-gray-300">{{ req.from }} - {{ req.to }}</span>
          <span class="ml-auto text-brand font-bold text-xs">Pending</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
const leaveBalances = [
  { type: 'Annual', balance: 12 },
  { type: 'Sick', balance: 5 },
  { type: 'Maternity', balance: 0 },
  { type: 'Other', balance: 2 }
];
const history = [
  { id: 1, type: 'Annual', from: '2023-01-10', to: '2023-01-15', status: 'Approved' },
  { id: 2, type: 'Sick', from: '2023-02-05', to: '2023-02-06', status: 'Approved' }
];
const pending = [
  { id: 1, type: 'Annual', from: '2023-03-01', to: '2023-03-03' }
];
</script> 