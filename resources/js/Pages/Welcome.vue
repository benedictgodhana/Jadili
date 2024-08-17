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
            <v-toolbar style="background-color:midnightblue;color:white"    >
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

        <!-- Carousel and Main Content -->
        <v-col cols="12" md="6">
          <!-- Carousel Section -->
          <v-carousel cycle height="300">
            <v-carousel-item v-for="(image, i) in carouselImages" :key="i">
              <v-img :src="image" cover></v-img>
            </v-carousel-item>
          </v-carousel>

          <!-- Projects Section -->


          <!-- News Section -->

        </v-col>

        <!-- Sidebar for Additional Info -->
        <!-- <v-col cols="12" md="3">
          <v-card>
            <v-card-title>Total Members</v-card-title>
            <hr>
            <v-card-text>
              <v-img src="@/assets/members-icon.jpg" max-height="150" class="mb-2"></v-img>
              Jadili has <strong>{{ userCount }}</strong> active members contributing to our mission.
            </v-card-text>
          </v-card>
          <v-card class="mt-4">
            <v-card-title>Resource Downloads</v-card-title>
            <v-card-text>
              Our resources have been downloaded <strong>7890</strong> times to date.
            </v-card-text>
          </v-card>
        </v-col> -->
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

export default {
  props: {
    userCount: Number
  },
  components: {
    Navbar,
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
      ]
    };
  }
};
</script>

<style>
h1 {
  font-size: 2rem;
  margin: 0;
}

.v-card-title {
  font-weight: bold;
}
</style>
