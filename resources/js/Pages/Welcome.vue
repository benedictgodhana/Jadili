<template>
    <v-app>
      <!-- Navbar -->
      <Navbar />

      <v-container class="mt-16">
        <!-- Header Section -->
        <v-row class="align-center mb-4 mt-16">
          <v-col cols="12">
            <v-text-field
              label="Search Jadili..."
              hide-details
              variant="outlined"
              prepend-inner-icon="mdi-magnify"
              class="mx-0"
            ></v-text-field>
          </v-col>
        </v-row>

        <!-- Main Content Section -->
        <v-row>
          <!-- Sidebar -->
          <v-col cols="12" md="3">
            <v-card>
              <v-toolbar style="background-color:midnightblue;color:white">
                <v-card-title>Engagements</v-card-title>
              </v-toolbar>
              <v-list dense nav>
                <v-list-item-group>
                  <v-list-item v-for="item in menuItems" :key="item.title">
                    <v-list-item-content>
                      <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-card>
          </v-col>

          <!-- Main Content -->
          <v-col cols="12" md="6">
            <!-- Response Statistics Section -->
            <v-card class="#">
              <v-toolbar style="background-color:midnightblue;color:white">
                <v-card-title>Response Statistics</v-card-title>
              </v-toolbar>
              <v-card-text>
                <v-row>
                  <v-col cols="12" md="6">
                    <v-card class="pa-3" elevation="2">
                      <v-card-title style="background-color:midnightblue;color:white">Total Responses</v-card-title>
                      <v-card-text>{{ totalResponses }}</v-card-text>
                    </v-card>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-card class="pa-3" elevation="2">
                      <v-card-title>Average Response Time</v-card-title>
                      <v-card-subtitle>{{ averageResponseTime }} mins</v-card-subtitle>
                    </v-card>
                  </v-col>
                </v-row>

                <!-- Highcharts Pie Charts -->
                <v-row>
                  <v-col cols="12" md="6">
                    <highcharts-chart
                      :options="responsesChartOptions"
                      class="highcharts-chart"
                    ></highcharts-chart>
                  </v-col>
                  <v-col cols="12" md="6">
                    <highcharts-chart
                      :options="usersChartOptions"
                      class="highcharts-chart"
                    ></highcharts-chart>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>

      <!-- Footer Section -->
      <v-footer style="background-color:midnightblue;color:white">
        <v-col class="text-center" cols="12">
          <v-row justify="center">
            <v-col class="mb-4">
              <v-img
                src="#"
                alt="Jadili Logo"
                max-height="90"
                contain
              ></v-img>
            </v-col>
          </v-row>
          <v-row justify="center">
            <v-btn text class="white--text" elevation="0" color="transparent">Dashboard</v-btn>
            <v-btn text class="white--text" elevation="0" color="transparent">View Responses</v-btn>
            <v-btn text class="white--text" elevation="0" color="transparent">Settings</v-btn>
            <v-btn text class="white--text" elevation="0" color="transparent">Help</v-btn>
          </v-row>
          <v-row justify="center" class="mt-4">
            <v-btn
              v-for="(icon, index) in socialIcons"
              :key="index"
              :icon="icon.icon"
              :href="icon.href"
              class="mx-2"
              elevation="0" color="transparent"
            ></v-btn>
          </v-row>
          <v-divider class="my-4"></v-divider>
          <div class="white--text">&copy; 2024 Jadili. All rights reserved.</div>
        </v-col>
      </v-footer>
    </v-app>
  </template>

  <script>
  import Navbar from '@/Components/Navbar.vue';
  import Highcharts from 'highcharts';
  import HighchartsVue from 'highcharts-vue';

  export default {
    components: {
      Navbar,
      HighchartsChart: HighchartsVue.component
    },
    props: {
      userCount: Number,
      totalResponses: Number,
      averageResponseTime: Number
    },
    data() {
      return {
        menuItems: [
          { title: "Community Development" },
          { title: "Youth Empowerment" },
          { title: "Health and Wellness" },
          { title: "Environmental Conservation" },
          { title: "Educational Programs" },
          { title: "Agricultural Support" },
          { title: "Small Business Support" },
          { title: "Cultural Heritage Preservation" },
          { title: "Emergency Relief" }
        ],
        carouselImages: [
          '/Images/community.jpg',
          '/Images/youth.jpg',
          '/Images/environment.jpg'
        ],
        socialIcons: [
          { icon: 'mdi-facebook', href: 'https://facebook.com/jadili' },
          { icon: 'mdi-twitter', href: 'https://twitter.com/jadili' },
          { icon: 'mdi-instagram', href: 'https://instagram.com/jadili' }
        ],
        responsesChartOptions: {
          chart: {
            type: 'pie'
          },
          title: {
            text: 'Responses Distribution'
          },
          series: [{
            name: 'Responses',
            data: [
              ['Completed', this.totalResponses], // Ensure these values are appropriate
              ['Incomplete', 100 - this.totalResponses] // Ensure these values are appropriate
            ]
          }]
        },
        usersChartOptions: {
          chart: {
            type: 'pie'
          },
          title: {
            text: 'Users Response Participation'
          },
          series: [{
            name: 'Users',
            data: [
              ['Responded', this.userCount], // Ensure these values are appropriate
              ['Not Responded', 100 - this.userCount] // Ensure these values are appropriate
            ]
          }]
        }
      };
    }
  };
  </script>

  <style>
  .highcharts-chart {
    width: 100%;
    height: 400px;
  }
  </style>
