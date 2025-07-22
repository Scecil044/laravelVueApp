<template>
  <div class="space-y-8">
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <div class="bg-brand/10 dark:bg-brand/20 rounded-xl p-4 flex flex-col items-center shadow">
        <i class="pi pi-inbox text-2xl text-brand mb-2"></i>
        <div class="text-2xl font-bold text-brand">128</div>
        <div class="text-xs text-gray-700 dark:text-gray-200">Total Requests</div>
      </div>
      <div class="bg-yellow-100 dark:bg-yellow-900 rounded-xl p-4 flex flex-col items-center shadow">
        <i class="pi pi-clock text-2xl text-yellow-500 mb-2"></i>
        <div class="text-2xl font-bold text-yellow-500">12</div>
        <div class="text-xs text-gray-700 dark:text-gray-200">Pending Approvals</div>
      </div>
      <div class="bg-green-100 dark:bg-green-900 rounded-xl p-4 flex flex-col items-center shadow">
        <i class="pi pi-check-circle text-2xl text-green-500 mb-2"></i>
        <div class="text-2xl font-bold text-green-500">102</div>
        <div class="text-xs text-gray-700 dark:text-gray-200">Approved</div>
      </div>
      <div class="bg-red-100 dark:bg-red-900 rounded-xl p-4 flex flex-col items-center shadow">
        <i class="pi pi-times-circle text-2xl text-red-500 mb-2"></i>
        <div class="text-2xl font-bold text-red-500">14</div>
        <div class="text-xs text-gray-700 dark:text-gray-200">Rejected/Cancelled</div>
      </div>
    </div>
    <!-- Charts Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white dark:bg-dark-bg rounded-2xl p-6 shadow border border-white/10 flex flex-col items-center">
        <RequestBarChart />
      </div>
      <div class="bg-white dark:bg-dark-bg rounded-2xl p-6 shadow border border-white/10 flex flex-col items-center">
        <RequestDonutChart />
      </div>
      <div class="bg-white dark:bg-dark-bg rounded-2xl p-6 shadow border border-white/10 flex flex-col items-center">
        <RequestSpeedometer />
      </div>
    </div>
    <!-- Recent Requests Table -->
    <div class="bg-white dark:bg-dark-bg rounded-2xl p-6 shadow border border-white/10">
      <RecentRequestsTable />
    </div>
  </div>
</template>

<script setup>
import RequestBarChart from './RequestBarChart.vue';
import RequestDonutChart from './RequestDonutChart.vue';
import RequestSpeedometer from './RequestSpeedometer.vue';
import RecentRequestsTable from './RecentRequestsTable.vue';
</script> 