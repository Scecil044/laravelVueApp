<template>
  <div class="w-full h-64 flex items-center justify-center">
    <Bar :data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup>
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

const chartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
  datasets: [
    {
      label: 'Requests',
      data: [12, 19, 14, 17, 22, 15],
      backgroundColor: 'rgba(221,5,49,0.8)', // brand color
      borderRadius: 8,
      barThickness: 32
    }
  ]
};
const chartOptions = {
  responsive: true,
  plugins: { legend: { display: false } },
  scales: {
    x: { grid: { display: false }, ticks: { color: '#a1a1aa' } },
    y: { beginAtZero: true, grid: { color: '#ffffff10' }, ticks: { color: '#a1a1aa' } }
  }
};
</script> 