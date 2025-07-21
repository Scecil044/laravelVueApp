<!-- Dashboard.vue -->
<template>
  <div class="main-panel space-y-8">
    <!-- Shortcuts -->
    <section class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div v-for="(shortcut, i) in shortcuts" :key="i" class="shortcut-card">
        <div class="shortcut-icon" :class="shortcut.bg">
          <i :class="shortcut.icon"></i>
        </div>
        <span class="shortcut-label">{{ shortcut.label }}</span>
      </div>
    </section>

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

    <!-- Main Widgets Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Left Column -->
      <div class="flex flex-col gap-6 col-span-2">
        <!-- Tasks & Bank Accounts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Tasks -->
          <div class="widget-card">
            <h2 class="section-title">Tasks</h2>
            <div v-for="(task, i) in tasks" :key="i" class="task-item" :class="task.status === 'overdue' ? 'task-overdue' : ''">
              <div class="flex-1">
                <span class="task-status" v-if="task.status === 'overdue'">OVERDUE</span>
                <span class="task-desc">{{ task.desc }}</span>
              </div>
              <button class="task-btn">Go</button>
            </div>
          </div>
          <!-- Bank Accounts -->
          <div class="widget-card">
            <h2 class="section-title">Bank Accounts</h2>
            <ul class="space-y-2">
              <li v-for="(acc, i) in bankAccounts" :key="i" class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <i class="pi pi-credit-card text-lg text-indigo-400"></i>
                  <span class="font-medium dark:text-gray-200">{{ acc.name }}</span>
                </div>
                <span :class="['font-semibold', acc.status === 'Reviewed' ? 'text-green-400' : 'text-gray-400']">{{ acc.balance }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!-- Sales Overview Chart -->
        <div class="chart-card">
      <h2 class="section-title">Sales Overview</h2>
          <Bar :data="barChartData" :options="barChartOptions" />
        </div>
        <!-- Cash Flow Trend -->
        <div class="widget-card">
          <h2 class="section-title">Cash Flow Trend</h2>
          <Line :data="cashFlowChartData" :options="cashFlowChartOptions" />
        </div>
      </div>
      <!-- Right Column -->
      <div class="flex flex-col gap-6">
        <!-- Invoices -->
        <div class="widget-card">
          <h2 class="section-title">Invoices</h2>
          <div class="mb-2">
            <span class="font-bold text-lg">{{ invoices.unpaid }} Unpaid</span>
            <span class="ml-2 text-gray-400 text-sm">Last 365 days</span>
          </div>
          <div class="flex items-center gap-2 mb-2">
            <span class="text-red-400 font-semibold">AED {{ invoices.unpaidAmount }}</span>
            <span class="text-xs">Overdue</span>
            <div class="flex-1 h-2 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">
              <div class="h-full bg-red-400" :style="{ width: invoices.unpaidPercent + '%' }"></div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-green-400 font-semibold">AED {{ invoices.paidAmount }}</span>
            <span class="text-xs">Paid</span>
            <div class="flex-1 h-2 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">
              <div class="h-full bg-green-400" :style="{ width: invoices.paidPercent + '%' }"></div>
            </div>
          </div>
        </div>
        <!-- Apps -->
        <div class="widget-card">
          <h2 class="section-title">My Apps</h2>
          <div class="flex items-center gap-2 mb-2">
            <span class="font-bold text-2xl">{{ apps.total }}</span>
            <span class="text-xs text-gray-400">Total</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-green-400 font-semibold">{{ apps.connected }} Connected</span>
            <span class="text-red-400 font-semibold">{{ apps.issues }} With issues</span>
          </div>
        </div>
        <!-- Accounts Payable/Receivable -->
        <div class="widget-card">
          <h2 class="section-title">Accounts Payable</h2>
          <Doughnut :data="apChartData" :options="donutChartOptions" />
        </div>
        <div class="widget-card">
          <h2 class="section-title">Accounts Receivable</h2>
          <Doughnut :data="arChartData" :options="donutChartOptions" />
        </div>
        <!-- Profit & Loss -->
        <div class="widget-card">
          <h2 class="section-title">Profit & Loss</h2>
          <div class="mb-2">
            <span class="font-bold text-lg">Net Profit: AED {{ profitLoss.net }}</span>
            <span class="ml-2 text-gray-400 text-sm">Last month</span>
          </div>
          <div class="flex items-center gap-2 mb-2">
            <span class="text-green-400 font-semibold">AED {{ profitLoss.income }}</span>
            <span class="text-xs">Income</span>
            <div class="flex-1 h-2 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">
              <div class="h-full bg-green-400" :style="{ width: profitLoss.incomePercent + '%' }"></div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-red-400 font-semibold">AED {{ profitLoss.expenses }}</span>
            <span class="text-xs">Expenses</span>
            <div class="flex-1 h-2 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">
              <div class="h-full bg-red-400" :style="{ width: profitLoss.expensesPercent + '%' }"></div>
            </div>
          </div>
        </div>
        <!-- Expenses Breakdown -->
        <div class="widget-card">
          <h2 class="section-title">Expenses</h2>
          <!-- <Doughnut :data="donutChartData" :options="donutChartOptions" /> -->
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

const shortcuts = ref([
  { label: 'Create invoice', icon: 'pi pi-file-edit', bg: 'bg-indigo-100 dark:bg-indigo-900 text-indigo-500' },
  { label: 'Record expense', icon: 'pi pi-dollar', bg: 'bg-pink-100 dark:bg-pink-900 text-pink-500' },
  { label: 'Add bank deposit', icon: 'pi pi-plus-circle', bg: 'bg-green-100 dark:bg-green-900 text-green-500' },
  { label: 'Create cheque', icon: 'pi pi-credit-card', bg: 'bg-yellow-100 dark:bg-yellow-900 text-yellow-500' },
]);

const cards = ref([
  { title: 'Net Income', value: '$17,500', subtitle: 'Last 30 days', icon: 'pi pi-wallet', iconBg: 'bg-gradient-to-tr from-indigo-500 to-pink-400 text-white' },
  { title: 'Expenses', value: '$18,000', subtitle: 'Last 30 days', icon: 'pi pi-arrow-down', iconBg: 'bg-gradient-to-tr from-pink-500 to-yellow-400 text-white' },
  { title: 'Invoices', value: '$147,344', subtitle: 'Unpaid (365 days)', icon: 'pi pi-file-invoice', iconBg: 'bg-gradient-to-tr from-green-400 to-blue-400 text-white' },
  { title: 'Bank Balance', value: '$922,050', subtitle: 'Cash on hand', icon: 'pi pi-credit-card', iconBg: 'bg-gradient-to-tr from-purple-500 to-indigo-400 text-white' },
]);

const tasks = ref([
  { status: 'overdue', desc: 'Remind your customers about 2 unpaid invoices' },
  { status: 'overdue', desc: 'Pay 2 overdue bills' },
]);

const bankAccounts = ref([
  { name: 'Bank', balance: 'AED 95,092', status: 'Reviewed' },
  { name: '123,124 Pet', balance: 'AED 1,567.09', status: 'Reviewed' },
  { name: 'Cash and cash equivalents', balance: 'AED 123,798.19', status: 'Reviewed' },
  { name: 'Test Account', balance: '€200.00', status: 'Reviewed' },
  { name: 'Master card 0011', balance: 'AED 1,567.05', status: 'Reviewed' },
]);

const invoices = ref({
  unpaid: 5.1,
  unpaidAmount: 5100,
  unpaidPercent: 74,
  paidAmount: 1800,
  paidPercent: 26,
});

const apps = ref({
  total: 10,
  connected: 2,
  issues: 8,
});

const apChartData = ref({
  labels: ['AED1,101.50', 'AED101.50', '7 days'],
  datasets: [
    {
      data: [900, 200, 95],
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
const arChartData = ref({
  labels: ['AED1,246', '7 days', 'AED0.00'],
  datasets: [
    {
      data: [1000, 200, 0],
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

const profitLoss = ref({
  net: 1937,
  income: 2961,
  incomePercent: 75,
  expenses: 1024,
  expensesPercent: 25,
});

// Sales Overview Chart (Bar)
const barChartData = ref({
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Sales',
      data: [12000, 15000, 14000, 18000, 17000, 20000],
      backgroundColor: function(context) {
        const chart = context.chart;
        const {ctx, chartArea} = chart;
        if (!chartArea) return 'rgba(99,102,241,0.8)';
        const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
        gradient.addColorStop(0, '#6366f1');
        gradient.addColorStop(1, '#a21caf');
        return gradient;
      },
      borderRadius: 12,
      barThickness: 32,
      borderSkipped: false,
      hoverBackgroundColor: '#818cf8',
      shadowOffsetX: 0,
      shadowOffsetY: 4,
      shadowBlur: 10,
      shadowColor: 'rgba(99,102,241,0.2)'
    }
  ]
});
const barChartOptions = ref({
  responsive: true,
  plugins: {
    legend: { display: false },
    tooltip: {
      backgroundColor: '#18181b',
      titleColor: '#fff',
      bodyColor: '#fff',
      borderColor: '#6366f1',
      borderWidth: 1
    }
  },
  scales: {
    x: {
      grid: { display: false },
      ticks: { color: '#e0e7ef' }
    },
    y: {
      beginAtZero: true,
      grid: { color: '#ffffff10' },
      ticks: { color: '#e0e7ef' }
    }
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

const cashFlowChartData = ref({
  labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Cash Flow',
      data: [500, 800, 600, 900, 1200],
      borderColor: '#6366f1',
      backgroundColor: 'rgba(99,102,241,0.1)',
      tension: 0.4,
      fill: true,
      pointBackgroundColor: '#6366f1',
      pointBorderColor: '#fff',
      pointRadius: 5
    }
  ]
});
const cashFlowChartOptions = ref({
  responsive: true,
  plugins: { legend: { display: false } },
  scales: {
    x: { grid: { display: false }, ticks: { color: '#a1a1aa' } },
    y: { beginAtZero: true, grid: { color: '#ffffff10' }, ticks: { color: '#a1a1aa' } }
  }
});

// Expenses Breakdown (Thinner Donut)
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
  cutout: '80%', // thinner ring
  plugins: {
    legend: {
      labels: { color: '#e0e7ef', font: { weight: 'bold' } }
    },
    tooltip: {
      backgroundColor: '#18181b',
      titleColor: '#fff',
      bodyColor: '#fff',
      borderColor: '#6366f1',
      borderWidth: 1
    }
  }
});
</script>

<style scoped>
.main-panel {
  @apply flex-1 p-6 lg:p-8 overflow-y-auto bg-gray-50 dark:bg-dark-bg min-h-screen;
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
.shortcut-card {
  @apply flex flex-col items-center justify-center gap-2 bg-white/80 dark:bg-white/5 border border-white/10 rounded-xl p-4 shadow hover:shadow-indigo-500/20 transition-all duration-300 cursor-pointer;
}
.shortcut-icon {
  @apply w-12 h-12 flex items-center justify-center rounded-full text-2xl mb-1 shadow;
}
.shortcut-label {
  @apply text-xs font-medium text-gray-700 dark:text-gray-200;
}
.widget-card {
  @apply bg-white/80 dark:bg-white/5 border border-white/10 rounded-2xl p-5 shadow flex flex-col mb-2;
}
.task-item {
  @apply flex items-center gap-3 p-3 rounded-lg mb-2 bg-gray-100 dark:bg-white/10;
}
.task-overdue {
  @apply border-l-4 border-red-400;
}
.task-status {
  @apply text-xs font-bold text-red-400 mr-2;
}
.task-desc {
  @apply text-sm text-gray-700 dark:text-gray-200;
}
.task-btn {
  @apply px-3 py-1 bg-indigo-500 text-white rounded-lg text-xs font-semibold hover:bg-indigo-600 transition;
}
.chart-card {
  @apply bg-white/80 dark:bg-white/5 border border-white/10 rounded-2xl p-6 shadow-lg;
}
.section-title {
  @apply text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4;
}
</style>