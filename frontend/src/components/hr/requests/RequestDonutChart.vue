<template>
  <div class="w-full h-64 flex items-center justify-center">
    <Doughnut :data="chartData" :options="chartOptions" />
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
  labels: ['Leave', 'WFH', 'Training', 'Other'],
  datasets: [
    {
      label: 'Request Types',
      data: [45, 25, 18, 10],
      backgroundColor: [
        'rgba(221,5,49,0.8)', // brand
        'rgba(99,102,241,0.8)', // indigo
        'rgba(16,185,129,0.8)', // green
        'rgba(251,191,36,0.8)'  // yellow
      ],
      borderWidth: 2,
      borderColor: '#18181b',
      cutout: '70%'
    }
  ]
};
const chartOptions = {
  responsive: true,
  plugins: {
    legend: {
      position: 'bottom',
      labels: { color: '#a1a1aa', font: { weight: 'bold' } }
    }
  }
};
</script> 