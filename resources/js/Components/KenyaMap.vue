<template>
    <div ref="chartContainer" style="width: 100%; height: 600px;"></div>
  </template>

  <script>
  import { defineComponent, onMounted, onBeforeUnmount, ref } from 'vue';
  import * as echarts from 'echarts';
  import axios from 'axios';

  export default defineComponent({
    name: 'MapChart',
    setup() {
      const chartContainer = ref(null);
      let myChart = null;
      let currentOption = null;

      // Define the map and bar chart options
      const mapOption = {
        visualMap: {
          left: 'right',
          min: 500000,
          max: 38000000,
          inRange: {
            color: ['#313695', '#4575b4', '#74add1', '#abd9e9', '#e0f3f8', '#ffffbf', '#fee090', '#fdae61', '#f46d43', '#d73027', '#a50026']
          },
          text: ['High', 'Low'],
          calculable: true
        },
        series: [
          {
            id: 'population',
            type: 'map',
            roam: true,
            map: 'USA',
            animationDurationUpdate: 1000,
            universalTransition: true,
            data: [] // This will be filled dynamically
          }
        ]
      };

      const barOption = {
        xAxis: {
          type: 'value'
        },
        yAxis: {
          type: 'category',
          axisLabel: {
            rotate: 30
          },
          data: [] // This will be filled dynamically
        },
        animationDurationUpdate: 1000,
        series: {
          type: 'bar',
          id: 'population',
          data: [] // This will be filled dynamically
        }
      };

      // Fetch the map data and initialize the chart
      const initializeChart = async () => {
        myChart = echarts.init(chartContainer.value);
        myChart.showLoading();
        try {
          const response = await axios.get('https://echarts.apache.org/examples/data/asset/geo/USA.json');
          const usaJson = response.data;
          myChart.hideLoading();
          echarts.registerMap('USA', usaJson, {
            Alaska: {
              left: -131,
              top: 25,
              width: 15
            },
            Hawaii: {
              left: -110,
              top: 28,
              width: 5
            },
            'Puerto Rico': {
              left: -76,
              top: 26,
              width: 2
            }
          });
          // Sample data
          const data = [
            { name: 'Alabama', value: 4822023 },
            { name: 'Alaska', value: 731449 },
            // Add all other states here
          ];
          data.sort((a, b) => a.value - b.value);

          mapOption.series[0].data = data;
          barOption.yAxis.data = data.map(item => item.name);
          barOption.series.data = data.map(item => item.value);

          currentOption = mapOption;
          myChart.setOption(mapOption);

          setInterval(() => {
            currentOption = currentOption === mapOption ? barOption : mapOption;
            myChart.setOption(currentOption, true);
          }, 2000);
        } catch (error) {
          console.error('Error fetching or registering map data:', error);
        }
      };

      onMounted(() => {
        initializeChart();
      });

      onBeforeUnmount(() => {
        if (myChart) {
          myChart.dispose();
        }
      });

      return { chartContainer };
    }
  });
  </script>

  <style scoped>
  /* Add any additional styles here */
  </style>
