<template>
    <v-app-bar
      app
      flat
      elevation="1"
      class="nav-bar"
    >
      <v-container class="d-flex align-center justify-space-between">

        <!-- Logo -->
        <v-img
          src="/Images/WhatsApp_Image_2024-08-16_at_23.21.20-removebg-preview.png"
          alt="Jadili Logo"
          class="logo"
          max-width="120"
        />

        <!-- Title -->
        <v-btn text class="nav-title"><span style="color:green">J</span><span style="color:red">A</span><span style="color:black">D</span><span style="color:lightgreen">I</span><span style="color:black">L</span> <span style="color:red">I</span> USSD</v-btn>

        <!-- Navigation Links -->
        <div class="nav-links">
          <v-btn text class="nav-link" href="/">
            <v-icon left>mdi-chart-line</v-icon> Dashboard
          </v-btn>
          <v-btn text class="nav-link" :href="route('response')">
            <v-icon left>mdi-format-list-bulleted</v-icon> View Responses
          </v-btn>
          <v-btn text class="nav-link">
            <v-icon left>mdi-settings</v-icon> Settings
          </v-btn>
          <v-btn text class="nav-link">
            <v-icon left>mdi-help-circle</v-icon> Help
          </v-btn>
        </div>

        <!-- Auth Links -->
        <div class="nav-links">
          <v-btn :href="route('register')" class="nav-link mr-4" elevation="0">
            Register <v-icon>mdi-account-plus</v-icon>
          </v-btn>
          <v-btn :href="route('login')" class="nav-link" elevation="0">
            Log In <v-icon>mdi-login</v-icon>
          </v-btn>
        </div>
      </v-container>
    </v-app-bar>
  </template>

  <script setup>
  import { VImg, VIcon } from 'vuetify/components';
  import { ref, onMounted, onUnmounted } from 'vue';

  const route = (name) => `/${name}`; // Dummy route function for demonstration

  const isScrolled = ref(false);

  const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
  };

  onMounted(() => {
    window.addEventListener('scroll', handleScroll);
  });

  onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
  });
  </script>

  <style scoped>
  .nav-bar {
    height: 80px;
    transition: background-color 0.3s ease;
    padding: 10px;
    background-color:white;
  }

  .logo {
    max-width: 120px;
    height: auto;
  }

  .nav-title {
    font-weight: bold;
    color: white;
    text-transform: capitalize;
    font-size: 20px;
  }

  .nav-links .nav-link {
    color:black;
    text-decoration: none;
    font-weight: 500;
    text-transform: capitalize;
    margin-right: 20px;
  }

  .nav-links .nav-link:hover {
    color: blue;
  }

  .auth-links .nav-link {
    color: white;
    text-transform: capitalize;
    background-color: blue;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 4px;
  }

  .auth-links .nav-link:hover {
    background-color: darkblue;
  }

  .ms-4 {
    margin-left: 1rem;
  }
  </style>
