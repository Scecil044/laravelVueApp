<template>
  <div class="w-full h-64 flex items-center justify-center relative">
    <Doughnut :data="chartData" :options="chartOptions" />
    <div class="absolute text-center w-full top-1/2 left-0 -translate-y-1/2 pointer-events-none">
      <div class="text-2xl font-bold text-brand">37%</div>
      <div class="text-xs text-gray-700 dark:text-gray-200">Approval Rate</div>
    </div>
  </div>
</template>

<script setup>
import { Doughnut } from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement
} from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, ArcElement);

const chartData = {
  labels: ['Approved', 'Other'],
  datasets: [
    {
      data: [37, 63],
      backgroundColor: [
        'rgba(16,185,129,0.8)', // green
        'rgba(221,5,49,0.2)' // faded brand
      ],
      borderWidth: 0,
      cutout: '80%',
      circumference: 180,
      rotation: 270
    }
  ]
};
const chartOptions = {
  responsive: true,
  plugins: { legend: { display: false }, tooltip: { enabled: false } },
};
</script> 