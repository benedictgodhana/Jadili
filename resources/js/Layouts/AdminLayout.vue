<template>
    <v-app>
      <!-- App Bar -->
      <v-app-bar app class="border-b" height="60" elevation="2" style="background-color: midnightblue">
        <!-- Drawer Icon -->

        <!-- Navigation Buttons in the App Bar -->
        <v-spacer></v-spacer>
        <v-btn
          v-for="(item, i) in items"
          :key="i"
          :href="item.routeName"
          class="nav-button"
          text
          style="color: white;"
        >
          <v-icon>{{ item.icon }}</v-icon>
          {{ item.text }}
        </v-btn>

        <!-- Logout Button -->
        <v-btn  @click="$inertia.post(route('logout'))"   class="nav-button mr-8"
 >
       Logout   <v-icon size="16">mdi-logout</v-icon>
        </v-btn>
      </v-app-bar>

      <!-- Main Content Area -->
      <v-main>
        <v-container fluid class="mt-10">
          <slot></slot>
        </v-container>
      </v-main>
    </v-app>
  </template>

  <script setup>
  import { ref } from 'vue';
  import { usePage } from '@inertiajs/inertia-vue3';

  const { props } = usePage();

  const items = [
    { text: 'Dashboard', routeName: 'admin', icon: 'mdi-view-dashboard' },
    { text: 'User Management', routeName: 'users', icon: 'mdi-account-multiple' },
    { text: 'Role Management', routeName: 'manage-roles', icon: 'mdi-account-group' },
    { text: 'All Applications', routeName: 'contributions', icon: 'mdi-file' },
    { text: 'Reports', routeName: 'reports', icon: 'mdi-file-document' },
  ];
  </script>

  <style scoped>
  .v-main {
    overflow-y: auto;
    height: calc(100vh - 60px); /* Subtract the height of the app bar */
  }

  .nav-button {
    text-transform: capitalize;
    font-weight: 500;
    color: white;
    margin: 0 10px; /* Adjust spacing between buttons */
  }

  .nav-button:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Optional: Add a hover effect */
  }

  .v-app-bar {
    background-color: midnightblue;
    color: white;
  }

  .v-btn {
    margin-left: 15px; /* Space between buttons */
  }
  </style>
