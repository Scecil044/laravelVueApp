<template>
  <div class="flex flex-col min-h-screen bg-gray-50">
    <TopNav class="sticky top-0 z-10" />
    <div class="flex flex-1 flex-col md:flex-row">
      <Sidebar class="w-full md:w-64 flex-shrink-0" />
      <main class="flex-1 p-4 md:p-8 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
          <Card v-for="card in cards" :key="card.title" class="shadow-lg">
            <template #title>{{ card.title }}</template>
            <template #content>
              <div class="text-3xl font-bold text-primary-600">{{ card.value }}</div>
              <div class="text-sm text-gray-500">{{ card.subtitle }}</div>
            </template>
          </Card>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4">
          <h2 class="text-lg font-semibold mb-4">Overview</h2>
          <Bar :data="chartData" :options="chartOptions" />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useUserStore } from '@/store/useUserStore';
import Sidebar from '@/components/common/Sidebar.vue';
import TopNav from '@/components/common/TopNav.vue';
import Card from 'primevue/card';
import { Bar } from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const userStore = useUserStore();

const cards = ref([
  { title: 'Users', value: 1200, subtitle: 'Active this month' },
  { title: 'Sales', value: '$34,000', subtitle: 'Total revenue' },
  { title: 'Growth', value: '12%', subtitle: 'Monthly increase' },
]);

const chartData = ref({
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Sales',
      backgroundColor: '#6366f1',
      data: [12000, 15000, 14000, 18000, 17000, 20000],
      borderRadius: 8,
    },
  ],
});

const chartOptions = ref({
  responsive: true,
  plugins: {
    legend: { display: false },
    title: { display: false },
  },
  scales: {
    x: { grid: { display: false } },
    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
  },
});
</script>

<style scoped>
main {
  min-height: 80vh;
}
</style>