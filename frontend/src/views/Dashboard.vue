<!-- Dashboard.vue -->
<template>
  <div class="main-panel space-y-8">
    <!-- KPI Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div v-for="(c, i) in cards" :key="i" class="kpi-card flex items-center gap-4">
        <div :class="['icon-box', c.iconBg]">
          <i :class="c.icon"></i>
        </div>
        <div>
          <h3 class="kpi-title">{{ c.title }}</h3>
          <p class="kpi-value">{{ c.value }}</p>
          <span class="kpi-subtitle">{{ c.subtitle }}</span>
        </div>
      </div>
    </section>
    <!-- Charts -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="chart-card col-span-2">
        <h2 class="section-title">Sales Overview</h2>
        <Bar :data="barChartData" :options="barChartOptions" />
      </div>
      <div class="chart-card flex flex-col gap-6">
        <div>
          <h2 class="section-title">Revenue Trend</h2>
          <Line :data="lineChartData" :options="lineChartOptions" />
        </div>
        <div>
          <h2 class="section-title">Expense Breakdown</h2>
          <Doughnut :data="donutChartData" :options="donutChartOptions" />
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Bar, Line, Doughnut } from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  LineElement,
  ArcElement,
  CategoryScale,
  LinearScale,
  PointElement
} from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, LineElement, ArcElement, CategoryScale, LinearScale, PointElement);

const cards = ref([
  { title: 'Net Income', value: '$17,500', subtitle: 'Last 30 days', icon: 'pi pi-wallet', iconBg: 'bg-gradient-to-tr from-indigo-500 to-pink-400 text-white' },
  { title: 'Expenses', value: '$18,000', subtitle: 'Last 30 days', icon: 'pi pi-arrow-down', iconBg: 'bg-gradient-to-tr from-pink-500 to-yellow-400 text-white' },
  { title: 'Invoices', value: '$147,344', subtitle: 'Unpaid (365 days)', icon: 'pi pi-file-invoice', iconBg: 'bg-gradient-to-tr from-green-400 to-blue-400 text-white' },
  { title: 'Bank Balance', value: '$922,050', subtitle: 'Cash on hand', icon: 'pi pi-credit-card', iconBg: 'bg-gradient-to-tr from-purple-500 to-indigo-400 text-white' },
]);

const barChartData = ref({
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Sales',
      data: [12000, 15000, 14000, 18000, 17000, 20000],
      backgroundColor: 'rgba(99,102,241,0.8)',
      borderRadius: 8,
      barThickness: 24
    }
  ]
});
const barChartOptions = ref({
  responsive: true,
  plugins: { legend: { display: false } },
  scales: {
    x: { grid: { display: false }, ticks: { color: '#a1a1aa' } },
    y: { beginAtZero: true, grid: { color: '#ffffff10' }, ticks: { color: '#a1a1aa' } }
  }
});

const lineChartData = ref({
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Revenue',
      data: [10000, 12000, 15000, 13000, 17000, 21000],
      borderColor: '#f472b6',
      backgroundColor: 'rgba(236,72,153,0.1)',
      tension: 0.4,
      fill: true,
      pointBackgroundColor: '#f472b6',
      pointBorderColor: '#fff',
      pointRadius: 5
    }
  ]
});
const lineChartOptions = ref({
  responsive: true,
  plugins: { legend: { display: false } },
  scales: {
    x: { grid: { display: false }, ticks: { color: '#a1a1aa' } },
    y: { beginAtZero: true, grid: { color: '#ffffff10' }, ticks: { color: '#a1a1aa' } }
  }
});

const donutChartData = ref({
  labels: ['Marketing', 'Payroll', 'Operations'],
  datasets: [
    {
      label: 'Expenses',
      data: [6000, 8000, 4000],
      backgroundColor: [
        'rgba(99,102,241,0.8)',
        'rgba(236,72,153,0.8)',
        'rgba(16,185,129,0.8)'
      ],
      borderWidth: 2,
      borderColor: '#18181b'
    }
  ]
});
const donutChartOptions = ref({
  responsive: true,
  plugins: { legend: { labels: { color: '#a1a1aa' } } }
});
</script>

<style scoped>
.main-panel {
  @apply flex-1 p-6 lg:p-8 overflow-y-auto bg-gray-50 dark:bg-[#18181b] min-h-screen;
}
.kpi-card {
  @apply bg-white/80 dark:bg-white/5 border border-white/10 rounded-2xl p-6 shadow-lg hover:shadow-indigo-500/20 transition-all duration-300;
}
.icon-box {
  @apply w-14 h-14 flex items-center justify-center rounded-xl text-2xl shadow-lg shadow-indigo-500/10;
}
.kpi-title {
  @apply text-sm font-semibold text-gray-500 dark:text-gray-300;
}
.kpi-value {
  @apply text-2xl font-bold text-gray-900 dark:text-white;
}
.kpi-subtitle {
  @apply text-xs text-gray-400 mt-1;
}
.chart-card {
  @apply bg-white/80 dark:bg-white/5 border border-white/10 rounded-2xl p-6 shadow-lg;
}
.section-title {
  @apply text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4;
}
</style>