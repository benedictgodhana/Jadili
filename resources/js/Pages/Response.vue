<template>
    <v-app>
      <!-- Navbar -->
      <Navbar />

      <v-container class="mt-16">
        <!-- Header Section -->
        <v-row class="align-center mb-4 mt-16">
          <v-col cols="12" md="3">
            <v-text-field
              label="Search Responses..."
              hide-details
              variant="outlined"
              prepend-inner-icon="mdi-magnify"
              class="mx-0"
              v-model="searchQuery"
              @input="fetchData"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="3">
            <v-text-field
              label="Flow Name Filter"
              hide-details
              variant="outlined"
              prepend-inner-icon="mdi-magnify"
              class="mx-0"
              v-model="flowNameFilter"
              @input="fetchData"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="3">
            <v-text-field
              label="Response Filter"
              hide-details
              variant="outlined"
              prepend-inner-icon="mdi-magnify"
              class="mx-0"
              v-model="responseFilter"
              @input="fetchData"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="3">
            <v-btn @click="resetFilters" color="primary" class="mt-2" style="text-transform: capitalize;"><v-icon>mdi-undo</v-icon>Reset Filters</v-btn>
          </v-col>
        </v-row>

        <!-- Main Content Section -->
        <v-row>
          <!-- Responses Table -->
          <v-col cols="12">
            <v-card elevation="0">
              <v-card-title>Response Overview</v-card-title>
              <v-data-table
                :headers="tableHeaders"
                :items="filteredData"
                class="elevation-1"
              >
                <template v-slot:item.index="{ item }">
                  <span>{{ item.index }}</span>
                </template>
                <template v-slot:item.flow_name="{ item }">
                  <span>{{ item.flow_name }}</span>
                </template>
                <template v-slot:item.response="{ item }">
                  <span>{{ item.response }}</span>
                </template>
                <template v-slot:item.actions="{ item }">
                  <v-btn color="primary" @click="viewResponse(item)" style="text-transform: capitalize;">
                    <v-icon class="mr-4">mdi-eye</v-icon> View Response
                  </v-btn>
                </template>
              </v-data-table>
            </v-card>
          </v-col>
        </v-row>
      </v-container>

      <!-- Dialog for Viewing Response Details -->
      <v-dialog v-model="dialog" max-width="800px">
        <v-card rounded>
          <v-toolbar color="white">
            <v-card-title class="headline">Response Details</v-card-title>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="dialog = false" icon><v-icon>mdi-close</v-icon></v-btn>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text>
            <div><strong>Engagement Title:</strong> {{ selectedResponse.flow_name }}</div>
            <br>
            <hr>
            <br>

            <div><strong>Response:</strong> {{ selectedResponse.response }}</div>
            <br>
            <hr>
            <br>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!-- Footer Section -->
      <v-footer style="background-color:midnightblue;color:white">
        <v-col class="text-center" cols="12">
          <v-row justify="center">
            <v-col class="mb-4">
              <v-img src="#" alt="Jadili Logo" max-height="90" contain></v-img>
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

  export default {
    components: {
      Navbar,
    },
    props: {
      combinedData: Array,
    },
    data() {
      return {
        searchQuery: '',
        flowNameFilter: '',
        responseFilter: '',
        dialog: false,
        selectedResponse: {},
        tableHeaders: [
          { title: 'No.', value: 'index', sortable: false },
          { title: 'Engagement Title', value: 'flow_name' },
          { title: 'Response', value: 'response' },
          { title: 'Actions', value: 'actions', sortable: false },
        ],
        socialIcons: [
          { icon: 'mdi-facebook', href: 'https://facebook.com/jadili' },
          { icon: 'mdi-twitter', href: 'https://twitter.com/jadili' },
          { icon: 'mdi-instagram', href: 'https://instagram.com/jadili' },
        ],
      };
    },
    computed: {
      filteredData() {
        return this.combinedData
          .map((item, index) => ({ ...item, index: index + 1 })) // Add 1 to index to start numbering from 1
          .filter(item => {
            return (
              (this.flowNameFilter === '' || item.flow_name.toLowerCase().includes(this.flowNameFilter.toLowerCase())) &&
              (this.responseFilter === '' || item.response.toLowerCase().includes(this.responseFilter.toLowerCase())) &&
              (this.searchQuery === '' || item.flow_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.step_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.response.toLowerCase().includes(this.searchQuery.toLowerCase()))
            );
          });
      },
    },
    methods: {
      viewResponse(item) {
        this.selectedResponse = item;
        this.dialog = true;
      },
      fetchData() {
        this.$inertia.get('/response', { search: this.searchQuery, flow_name: this.flowNameFilter, response: this.responseFilter });
      },
      resetFilters() {
        this.searchQuery = '';
        this.flowNameFilter = '';
        this.responseFilter = '';
        this.fetchData(); // Optionally, re-fetch data after resetting
      },
    },
  };
  </script>

  <style scoped>
  h1 {
    font-size: 2rem;
    margin: 0;
  }

  .v-card-title {
    font-weight: bold;
  }
  </style>
