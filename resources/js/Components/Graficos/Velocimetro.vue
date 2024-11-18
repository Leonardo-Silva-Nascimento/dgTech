<template>
  <div>
    <div class="gauge-row">
      <div>
        <div id="gaugeArea1"></div>
      </div>
      <div>
        <div id="gaugeArea2"></div>
      </div>
      <div>
        <div id="gaugeArea3"></div>
      </div>
      <div>
        <div id="gaugeArea4"></div>
      </div>
    </div>
  </div>
</template>

<script setup>

import { ref, defineProps, watch, onMounted } from "vue";
import GaugeChart from 'gauge-chart';

onMounted(() => {
  const element1 = document.querySelector('#gaugeArea1');
  const element2 = document.querySelector('#gaugeArea2');
  const element3 = document.querySelector('#gaugeArea3');
  const element4 = document.querySelector('#gaugeArea4');

  const options1 = {
    arcColors: ['rgb(44, 151, 222)', 'lightgray'],
    arcDelimiters: [80],
    rangeLabel: ['0%', '100%'],
    centralLabel: '70%',
  };

  const options2 = {
    hasNeedle: true,
    needleColor: 'black',
    arcColors: ['rgb(255, 84, 84)', 'rgb(239, 214, 19)', 'rgb(61, 204, 91)'],
    arcDelimiters: [40, 60],
    rangeLabel: ['52', '8'],
    needleStartValue: 50,
  };

  const options3 = {
    hasNeedle: true,
    outerNeedle: true,
    needleColor: 'rgb(166, 206, 227)',
    arcDelimiters: [],
    rangeLabel: ['-10', '10'],
    centralLabel: '2',
    rangeLabelFontSize: 42,
  };

  const options5 = {
    hasNeedle: true,
    needleColor: 'black',
    arcColors: [],
    arcDelimiters: [10, 60, 90],
    arcPadding: 6,
    arcPaddingColor: 'white',
    arcLabels: ['35', '210', '315'],
    arcLabelFontSize: false,
    rangeLabel: ['0', '350'],
    centralLabel: '175',
    rangeLabelFontSize: false,
    labelsFont: 'Consolas',
  };

  GaugeChart.gaugeChart(element1, 400, options1).updateNeedle(70);
  GaugeChart.gaugeChart(element2, 400, options2).updateNeedle(20);
  GaugeChart.gaugeChart(element3, 400, options3).updateNeedle(60);
  GaugeChart.gaugeChart(element4, 400, options5).updateNeedle(30);
});
</script>
