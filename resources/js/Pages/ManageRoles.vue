<template>
    <AdminLayout>
        <v-col cols="12">
        <v-card max-width="1500" elevation="0">
          <v-card-title class="text-center" style="background-color:green; color: white;">
            Roles Management
            <v-spacer></v-spacer>
          </v-card-title>
          <br>
          <v-card-text>
            <v-btn color="primary" @click="importRoles" class="mr-4" label elevation="5" style="text-transform: capitalize">
              <v-icon left>mdi-upload</v-icon> Import
            </v-btn>
            <v-btn @click="printRoles" class="mr-4" label elevation="5" color="red" style="text-transform: capitalize">
              <v-icon left>mdi-printer</v-icon> Print
            </v-btn>
            <v-btn color="green" @click="exportRoles" class="mr-4" label elevation="5" style="text-transform: capitalize">
              <v-icon left>mdi-download</v-icon> Export
            </v-btn>
            <v-btn color="purple" @click="addRole" label elevation="5" style="text-transform: capitalize">
              <v-icon left>mdi-account-plus</v-icon> Add Role
            </v-btn>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-text>
            <v-table >
              <thead >
                <tr style="background-color: green;font-weight: 900;text-transform: uppercase;color:white">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Guard Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="role in roles" :key="role.id">
                  <td>{{ role.id }}</td>
                  <td>{{ role.name }}</td>
                  <td>{{ role.guard_name }}</td>
                  <td>

                            <v-btn icon color="white" elevation="0" class="mr-4" >
                              <v-icon color="green">mdi-pencil</v-icon>
                            </v-btn>

                            <v-btn icon color="white" elevation="0" >
                              <v-icon color="red">mdi-delete</v-icon>
                            </v-btn>

                    <!-- Edit Button with Dialog -->

                  </td>
                </tr>
              </tbody>
            </v-table>

            <v-dialog v-model="dialog.edit" max-width="500px">

                      <v-card>
                        <v-card-title>Edit Role</v-card-title>
                        <v-card-text>
                          <!-- Edit form or content here -->
                          <v-btn @click="saveEdit(role)">Save</v-btn>
                          <v-btn @click="dialog.edit = false">Cancel</v-btn>
                        </v-card-text>
                      </v-card>
                    </v-dialog>

                    <!-- Delete Button with Dialog -->
                    <v-dialog v-model="dialog.delete" max-width="500px">

                      <v-card>
                        <v-card-title>Delete Role</v-card-title>
                        <v-card-text>
                          <!-- Delete confirmation message -->
                          <div>Are you sure you want to delete "{{ role.name }}"?</div>
                          <v-btn @click="confirmDelete(role)">Confirm</v-btn>
                          <v-btn @click="dialog.delete = false">Cancel</v-btn>
                        </v-card-text>
                      </v-card>
                    </v-dialog>
          </v-card-text>
        </v-card>
    </v-col>
    </AdminLayout>
  </template>

  <script setup>
  import { ref } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';

  const { props } = usePage();
  const roles = ref(props.roles); // Assuming 'roles' prop is passed from backend

  // Dialog control
  const dialog = {
    edit: false,
    delete: false,
  };

  // Example function for editing a role
  const saveEdit = (role) => {
    // Implement your edit logic here
    console.log('Saving edit:', role);
    dialog.edit = false; // Close the dialog after saving
  };

  // Example function for deleting a role
  const confirmDelete = (role) => {
    // Implement your delete logic here
    console.log('Deleting role:', role);
    dialog.delete = false; // Close the dialog after deleting
  };

  // Example function for importing roles
  const importRoles = () => {
    // Implement your import logic here
    console.log('Importing roles');
  };

  // Example function for printing roles
  const printRoles = () => {
    // Implement your print logic here
    console.log('Printing roles');
  };

  // Example function for exporting roles
  const exportRoles = () => {
    // Implement your export logic here
    console.log('Exporting roles');
  };

  // Example function for adding a new role
  const addRole = () => {
    // Implement your add role logic here
    console.log('Adding a new role');
  };
  </script>

  <style scoped>
  /* Add scoped styles here */
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  .table th,
  .table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  </style>
