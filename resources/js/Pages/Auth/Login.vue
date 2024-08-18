<template>
    <v-container class="d-flex justify-center align-center min-vh-100 login-background" fluid>
        <Head title="Log in" />

        <v-card max-width="600" width="100%" class="elevation-0 login-card">
            <!-- Logo -->
            <a href="/">
                <v-img
                    src="/Images/WhatsApp_Image_2024-08-16_at_23.21.20-removebg-preview.png"
                    contain
                    max-width="200"
                    class="mx-auto mt-4"
                ></v-img>
            </a>

            <v-card-text>
                <div v-if="status" class="mb-4">
                    <v-alert type="success" dismissible>
                        {{ status }}
                    </v-alert>
                </div>

                <form @submit.prevent="submit">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                label="Email"
                                v-model="form.email"
                                required
                                variant="outlined"
                                autofocus
                                autocomplete="username"
                                :error-messages="form.errors.email"
                                prepend-inner-icon="mdi-email"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row class="">
                        <v-col cols="12">
                            <v-text-field
                                label="Password"
                                type="password"
                                v-model="form.password"
                                required
                                variant="outlined"
                                autocomplete="current-password"
                                :error-messages="form.errors.password"
                                prepend-inner-icon="mdi-lock"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-card-actions class="d-flex justify-end mt-4">
                        <v-btn
                            color="white"
                            :loading="form.processing"
                            @click="submit"
                            width="100%"
                            class="login-button"
                            variant="tonal"
                        >
                            Log in <v-icon>mdi-login</v-icon>
                        </v-btn>
                    </v-card-actions>

                    <v-row class="mt-2">
                        <v-col cols="12" class="d-flex justify-center">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="forgot-password-link mr-4"
                            >
                                Forgot your password?
                            </Link>

                            <Link
                                :href="route('register')"
                                   class="forgot-password-link"
                            >
                                Don't have an account?
                            </Link>
                        </v-col>
                    </v-row>
                </form>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { VContainer, VRow, VCol, VTextField, VCheckbox, VBtn, VAlert, VCard, VCardTitle, VCardText, VCardActions, VToolbar, VImg } from 'vuetify/components';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: (event) => {
            const response = event.detail.jetstream.response;
            if (response && response.status === 'success') {
                localStorage.setItem('token', response.token);

                if (response.role === 'admin') {
                    Inertia.visit(route('admin.dashboard'));
                } else {
                    Inertia.visit(route('dashboard'));
                }
            } else {
                console.error('Login unsuccessful');
            }
        },
    });
};
</script>

<style>
.min-vh-100 {
    min-height: 100vh;
}

.login-card {
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.9);
}

.login-button {
    background-color: midnightblue;
    color: white;
    font-weight: bold;
    text-transform: capitalize;
}

.forgot-password-link {
    color: gray;
    text-decoration: underline;
    font-size: 0.9rem;
}

.remember-checkbox .v-label {
    color: gray;
}

.v-card-title {
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
}

/* Background Image for the Login Page */
.login-background {
    position: relative;
    background-image: url('/Images/20123097.jpg'); /* Replace with the path to your image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Ensures background stays fixed during scroll */
    width: 100%;
    height: 100vh; /* Ensure it covers the full height of the viewport */
    z-index: 1;
}

.login-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Adjust the opacity as needed */
    z-index: -1;
}

</style>
