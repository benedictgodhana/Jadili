<template>
    <AdminLayout>
        <v-col cols="12">
        <!-- Main content of the page -->
        <v-card max-width="1900" elevation="0" width="100%">
          <v-card-title class="text-center" style="background-color:green; color: white; ">
            Users' List
            <v-spacer></v-spacer>
          </v-card-title>
          <br>
          <v-card-text>
            <v-btn color="primary" @click="importUsers" class="mr-4" label elevation="2" style="text-transform: capitalize" >
              <v-icon left>mdi-upload</v-icon> Import
            </v-btn>
            <!-- Print Button -->
            <v-btn @click="printUsers" class="mr-4" label elevation="2" style="text-transform: capitalize" color="red">
              <v-icon left>mdi-printer</v-icon> Print
            </v-btn>
            <!-- Export Button -->
            <v-btn color="green" @click="exportUsers" class="mr-4" label elevation="2" style="text-transform: capitalize" >
              <v-icon left>mdi-download</v-icon> Export
            </v-btn>
            <!-- Add Member Button -->
            <v-btn color="purple" @click="addMember" label elevation="2" style="text-transform: capitalize" >
              <v-icon left>mdi-account-plus</v-icon> Add a member
            </v-btn>
          </v-card-text>
          <v-divider></v-divider>
          <!-- Data Table -->
          <v-table>
            <template v-slot:default>
              <thead>
                <tr style="background-color: green;font-weight: 900;text-transform: uppercase;color:white">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.roles.join(', ') }}</td>
                  <td>
                    <v-chip icon color="white" @click="openDialog('edit', user)" elevation="0">
                      <v-icon color="green">mdi-pencil</v-icon>
                    </v-chip>
                    <v-chip icon color="white" @click="openDialog('view', user)" elevation="0">
                      <v-icon color="primary">mdi-eye</v-icon>
                    </v-chip>
                    <v-chip icon color="white" @click="openDialog('delete', user)" elevation="0">
                      <v-icon color="red">mdi-delete</v-icon>
                    </v-chip>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-table>
        </v-card>

        <!-- Edit Dialog -->
        <v-dialog v-model="dialog.edit" max-width="800px">
          <v-card>
            <v-toolbar color="orange">
              <v-card-title>Edit User</v-card-title>
              <v-spacer></v-spacer>
              <v-btn @click="dialog.edit = false" color="white" icon><v-icon>mdi-close</v-icon></v-btn>
            </v-toolbar>
            <v-card-text>
              <v-row>
                <v-col>
                  <v-btn @click="saveEdit(selectedUser)" class="mr-4" width="100%" color="green">
                    <v-icon>mdi-content-save</v-icon>Save
                  </v-btn>
                </v-col>
                <v-col>
                  <v-btn @click="dialog.edit = false" width="100%" color="red">
                    <v-icon>mdi-cancel</v-icon>Cancel
                  </v-btn>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-dialog>

        <!-- View Dialog -->
        <v-dialog v-model="dialog.view" max-width="800px">
          <v-card>
            <v-card-title style="background-color: orange;" class="text-center">View User</v-card-title>
            <v-card-text>
              <v-row>
                <!-- User Information -->
                <v-col cols="12" md="4">
                  <v-text-field v-model="selectedUser.name" label="Name" readonly variant="outlined"></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                  <v-text-field v-model="selectedUser.email" label="Email" readonly variant="outlined"></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                  <v-text-field :value="formattedRoles" label="Roles" readonly variant="outlined"></v-text-field>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-dialog>

        <!-- Delete Dialog -->
        <v-dialog v-model="dialog.delete" max-width="500px">
          <v-card>
            <v-toolbar color="orange">
              <v-toolbar-title>Delete User</v-toolbar-title>
              <v-btn @click="dialog.delete = false" color="white" icon><v-icon>mdi-close</v-icon></v-btn>
            </v-toolbar>
            <v-card-text>
              <div>Are you sure you want to delete "{{ selectedUser.name }}"?</div>
              <br>
              <v-row>
                <v-col>
                  <v-btn @click="confirmDelete(selectedUser)" class="mr-4" color="green" width="100%" rounded>
                    <v-icon>mdi-check</v-icon>Confirm
                  </v-btn>
                </v-col>
                <v-col>
                  <v-btn @click="dialog.delete = false" color="red" width="100%" rounded>
                    <v-icon>mdi-cancel</v-icon>Cancel
                  </v-btn>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-dialog>
    </v-col>
    </AdminLayout>
  </template>

  <script>
  import { ref, computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';

  export default {
    components: {
      AdminLayout,
    },
    data() {
      return {
        users: [],
        selectedUser: {
          name: '',
          email: '',
          roles: [],
          profile: {
            surname: '' // Add other default fields as needed
          }
        },
        dialog: {
          edit: false,
          view: false,
          delete: false,
        },
      };
    },
    created() {
      const { props } = usePage();
      this.users = props.users;
    },
    computed: {
      formattedRoles() {
        return this.selectedUser.roles ? this.selectedUser.roles.join(', ') : '';
      }
    },
    methods: {
      openDialog(type, user) {
        const defaultProfile = {
          surname: '',
          otherNames: '',
          dept: '',
          employmentType: '',
          employeeNo: '',
          dateOfBirth: '',
          sex: '',
          religion: '',
          telR: '',
          telCell: '',
          currentAddress: '',
          residence: '',
          postalAddress: '',
          homeDistrict: '',
          fatherName: '',
          fatherDOB: '',
          fatherOccupation: '',
          motherName: '',
          motherDOB: '',
          motherOccupation: '',
          maritalStatus: '',
          spouseName: '',
          dateOfMarriage: '',
          spouseTel: '',
          children: '',
          siblings: ''
        };

        this.selectedUser = {
          ...user,
          profile: user.profile ? { ...defaultProfile, ...user.profile } : defaultProfile
        };

        this.dialog[type] = true;
      },
      saveEdit(user) {
        console.log('Saving edit:', user);
        this.dialog.edit = false;
      },
      confirmDelete(user) {
        console.log('Deleting user:', user);
        this.dialog.delete = false;
      },
      importUsers() {
        console.log('Importing users');
      },
      printUsers() {
        console.log('Printing users');
      },
      exportUsers() {
        console.log('Exporting users');
      },
      addMember() {
        console.log('Adding a member');
      },
    },
  };
  </script>

  <style scoped>
  /* Add scoped styles here */
  </style>
