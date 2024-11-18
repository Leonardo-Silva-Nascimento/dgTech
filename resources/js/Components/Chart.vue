<template>
  <div>
    <Bar 
      v-if="type === 'bar'" 
      :class="!responsive ? 'h-[372px] w-full': styleDynamic"  
      :data="chartData" 
      :options="chartOptions" :type="type"
      :style="!responsive ? 'height: 372px; width: 100%;' : styleDynamic" :responsive="responsive"
      :styleDynamic="styleDynamic" 
    />
    <Pie 
      v-if="type === 'pie'" 
      :class="!responsive ? '': styleDynamic" 
      :data="chartData" 
      :options="chartOptions" :type="type"
      :style="!responsive ? 'height: 372px; width: 100%;' : styleDynamic" :responsive="responsive"
      :styleDynamic="styleDynamic" 
    />
    <Doughnut 
      v-if="type === 'doughnut'" 
      :class="!responsive ? '': styleDynamic" 
      :data="chartData" 
      :options="chartOptions" 
      :type="type"
    />
    <Line 
      v-if="type === 'line'" 
      :class="!responsive ? '': styleDynamic" 
      :data="chartData" :options="chartOptions" 
      :type="type"
      :style="!responsive ? 'height: 372px; width: 100%;' : styleDynamic" :responsive="responsive"
      :styleDynamic="styleDynamic" 
    />
  </div>
</template>

<script setup>
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement,
  PointElement,
  LineElement
} from 'chart.js'
import { Bar, Pie, Doughnut, Line } from 'vue-chartjs'

ChartJS.register(CategoryScale, LinearScale, BarElement, ArcElement, Title, Tooltip, Legend, LineElement, PointElement)

const props = defineProps({
  chartData: {
    type: Array,
    required: true
  },
  chartOptions: Object,
  type: {
    type: String,
    required: true
  },
  responsive: {
    type: Boolean,
    required: false
  },
  styleDynamic: {
    type: String,
    required: false
  }
});
</script>
