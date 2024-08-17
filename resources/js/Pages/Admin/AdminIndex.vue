<template>
    <Head title="Citizen Engagement Dashboard" />

    <AdminLayout>
      <v-container fluid>
        <v-row>
          <!-- Total Users -->
          <v-col cols="12" md="6" lg="3">
            <v-card class="pa-3" elevation="2">
              <v-card-title class="dashboard-card-title blue">
                <v-icon class="mr-2">mdi-account-multiple</v-icon>
                Total Users
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text class="text-center card-text">{{ totalUsers }}</v-card-text>
            </v-card>
          </v-col>

          <!-- Total USSD Responses -->
          <v-col cols="12" md="6" lg="3">
            <v-card class="pa-3" elevation="2">
              <v-card-title class="dashboard-card-title green">
                <v-icon class="mr-2">mdi-phone</v-icon>
                Total USSD Responses
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text class="text-center card-text">{{ totalUssdResponses }}</v-card-text>
            </v-card>
          </v-col>

          <!-- Total Educational Materials -->
          <v-col cols="12" md="6" lg="3">
            <v-card class="pa-3" elevation="2">
              <v-card-title class="dashboard-card-title teal">
                <v-icon class="mr-2">mdi-book</v-icon>
                Total Educational Materials
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text class="text-center card-text">{{ totalEducationalMaterials }}</v-card-text>
            </v-card>
          </v-col>

          <v-col cols="12" md="6" lg="3">
          <v-card class="pa-3" elevation="2">
            <v-card-title class="dashboard-card-title purple">
              <v-icon class="mr-2">mdi-account-check</v-icon>
              Users Submitted Today
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text class="text-center card-text">{{ usersSubmittedToday }}</v-card-text>
          </v-card>
        </v-col>


          <!-- Citizen Engagement Overview Chart -->
          <v-col cols="12">
            <v-card class="pa-3" elevation="2">
              <v-card-title class="text-center dashboard-chart-title"></v-card-title>
              <highcharts :options="engagementChartOptions" :key="engagementChartKey"></highcharts>
              <v-btn-toggle v-model="selectedEngagementChartType" mandatory class="mt-3">
                <v-btn @click="switchEngagementGraph('line')" class="chart-btn blue">
                  <v-icon>mdi-chart-line</v-icon> Line
                </v-btn>
                <v-btn @click="switchEngagementGraph('bar')" class="chart-btn green">
                  <v-icon>mdi-chart-bar</v-icon> Bar
                </v-btn>
                <v-btn @click="switchEngagementGraph('pie')" class="chart-btn teal">
                  <v-icon>mdi-chart-pie</v-icon> Pie
                </v-btn>
              </v-btn-toggle>
            </v-card>
          </v-col>


        </v-row>
      </v-container>
    </AdminLayout>
  </template>

<script>
import Highcharts from 'highcharts';
import HighchartsVue from 'highcharts-vue';
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

export default {
  name: 'CitizenEngagementDashboard',
  components: {
    Head,
    AdminLayout,
    highcharts: HighchartsVue.component,
  },
  props: {
    totalUsers: Number,
    totalUssdResponses: Number,
    totalEducationalMaterials: Number,
    usersSubmittedToday: Number, // New prop for users submitted today
    engagementsToday: Number, // New prop for engagements today
  },
  data() {
    return {
      engagementChartKey: 0,
      engagementChartOptions: {
        chart: {
          type: 'line',
          animation: {
            duration: 1000,
            easing: 'easeOutBounce',
          },
        },
        title: {
          text: 'Citizen Engagement Overview',
        },
        xAxis: {
          categories: ['Today', 'This Week', 'This Month'],
          title: {
            text: 'Period',
          },
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Engagement Count',
          },
        },
        series: [
          {
            name: 'USSD Responses',
            data: [this.totalUssdResponses], // USSD responses for today
            color: '#007BFF',
          },
          {
            name: 'Users Submitted Today',
            data: [this.usersSubmittedToday], // Number of users who submitted responses today
            color: '#28A745',
          },
          {
            name: 'Engagements',
            data: [this.engagementsToday], // Engagements today
            color: '#FFC107',
          },
        ],
        plotOptions: {
          series: {
            animation: {
              duration: 2000,
              easing: 'easeInOutQuad',
            },
          },
        },
      },
      selectedEngagementChartType: 'line',
      recentActivities: [
        { id: 1, title: 'Engagement with community leaders', date: '2024-08-15' },
        { id: 2, title: 'Sensitization workshop on public health', date: '2024-08-14' },
        { id: 3, title: 'Public forum on local governance', date: '2024-08-13' },
      ],
    };
  },
  methods: {
    switchEngagementGraph(type) {
      this.engagementChartOptions.chart.type = type;
      this.engagementChartKey += 1;
    },
  },
  mounted() {
    Highcharts.setOptions({
      colors: ['#007BFF', '#28A745', '#FFC107', '#17A2B8'],
    });
  },
};
</script>


  <style scoped>
  /* Style for cards and overall layout */
  .v-card {
    box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .v-card:hover {
    transform: scale(1.02);
  }

  .dashboard-card-title {
    font-size: 18px;
    font-weight: bold;
    color: white;
  }

  .blue { background-color: #007BFF; }
  .green { background-color: #28A745; }
  .teal { background-color: #17A2B8; }
  .yellow { background-color: #FFC107; }
  .purple { background-color: #6f42c1; } /* New color for USSD interactions */

  .card-text {
    font-size: 16px;
    font-weight: 700;
  }

  .dashboard-chart-title {
    font-size: 18px;
    font-weight: bold;
  }

  .chart-btn {
    text-transform: none;
    margin-right: 5px;
  }

  .recent-activities {
    margin-top: 20px;
  }
  </style>
