<!-- Dashboard.vue -->
<template>
  <div class="app-wrapper">
    <TopNav @toggle-sidebar="sidebarOpen = !sidebarOpen" />
    <div class="flex flex-1">
      <Sidebar :open="sidebarOpen" />
      <main class="main-panel">
        <!-- KPI Cards -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div
            v-for="(c, i) in cards"
            :key="i"
            class="kpi-card"
          >
            <h3>{{ c.title }}</h3>
            <p class="value">{{ c.value }}</p>
            <span class="subtitle">{{ c.subtitle }}</span>
          </div>
        </section>

        <!-- Chart -->
        <section class="chart-card">
          <h2 class="section-title">Sales Overview</h2>
          <Bar :data="chartData" :options="chartOptions" />
        </section>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from '@/components/common/Sidebar.vue';
import TopNav from '@/components/common/TopNav.vue';
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

const sidebarOpen = ref(false);

const cards = ref([
  { title: 'Users', value: '1 200', subtitle: 'Active this month' },
  { title: 'Sales', value: '$34 k', subtitle: 'Total revenue' },
  { title: 'Growth', value: '+12 %', subtitle: 'MoM increase' },
]);

const chartData = ref({
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Sales',
      data: [12, 15, 14, 18, 17, 20],
      backgroundColor: '#6366f1',
      borderRadius: 8,
      barThickness: 20
    }
  ]
});

const chartOptions = ref({
  responsive: true,
  plugins: { legend: { display: false } },
  scales: {
    x: { grid: { display: false } },
    y: { beginAtZero: true, grid: { color: '#ffffff10' } }
  }
});
</script>

<style scoped>
.app-wrapper {
  @apply flex flex-col min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black;
}
.main-panel {
  @apply flex-1 p-6 lg:p-8 overflow-y-auto;
}
.kpi-card {
  @apply bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-lg shadow-lg hover:shadow-indigo-500/20 transition-all duration-300;
}
.kpi-card .value {
  @apply text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-pink-400;
}
.kpi-card .subtitle {
  @apply text-sm text-gray-400 mt-1;
}
.chart-card {
  @apply bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-lg shadow-lg;
}
.section-title {
  @apply text-lg font-semibold text-gray-100 mb-4;
}
</style>