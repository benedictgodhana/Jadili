<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <v-container fluid>
            <v-row>
                <!-- Total Users Card -->
                <v-col cols="12" md="6" lg="3">
                    <v-card class="pa-3" elevation="14" rounded>
                        <v-card-title style="background-color: green; color:white">Total Users</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="font-size:18px;font-weight: 700;">{{ totalUsers }}</v-card-text>
                        <v-btn width="100%" color="orange" style="text-transform: none;">View All Users</v-btn>
                    </v-card>
                </v-col>

                <!-- Today's Applications Card -->
                <v-col cols="12" md="6" lg="3">
                    <v-card class="pa-3" elevation="14" rounded>
                        <v-card-title style="background-color: green; color:white">Today's Applications</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="font-size:18px;font-weight: 700;">{{ applicationsToday }}</v-card-text>
                        <v-btn width="100%" color="orange" style="text-transform: none;">View Today's Applications</v-btn>
                    </v-card>
                </v-col>

                <!-- This Week's Applications Card -->
                <v-col cols="12" md="6" lg="3">
                    <v-card class="pa-3" elevation="14" rounded>
                        <v-card-title style="background-color: green; color:white">This Week's Applications</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="font-size:18px;font-weight: 700;">{{ applicationsThisWeek }}</v-card-text>
                        <v-btn width="100%" color="orange" style="text-transform: none;">View This Week's Applications</v-btn>
                    </v-card>
                </v-col>

                <!-- Monthly Applications Card -->
                <v-col cols="12" md="6" lg="3">
                    <v-card class="pa-3" elevation="14" rounded>
                        <v-card-title style="background-color: green; color:white">Monthly Applications</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="font-size:18px;font-weight: 700;">{{ applicationsThisMonth }}</v-card-text>
                        <v-btn width="100%" color="orange" style="text-transform: none;">View Monthly Applications</v-btn>
                    </v-card>
                </v-col>

                <!-- Highcharts for Application Overview -->
                <v-col cols="12">
                    <v-card class="pa-3" elevation="5">
                        <v-card-title class="text-center" style="background-color:green; color:white">Application Overview</v-card-title>
                        <v-divider></v-divider>
                        <highcharts :options="applicationChartOptions" :key="applicationChartKey"></highcharts>
                        <v-btn-toggle v-model="selectedApplicationChartType" mandatory>
                            <v-btn @click="switchApplicationGraph('line')" style="background-color: green; color:white">
                                <v-icon>mdi-chart-line</v-icon>
                                Line
                            </v-btn>
                            <v-btn @click="switchApplicationGraph('bar')" style="background-color: orange; color:white">
                                <v-icon>mdi-chart-bar</v-icon>
                                Bar
                            </v-btn>
                            <v-btn @click="switchApplicationGraph('pie')" style="background-color: green; color:white">
                                <v-icon>mdi-chart-pie</v-icon>
                                Pie
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
    name: 'Dashboard',
    components: {
        Head,
        AdminLayout,
        highcharts: HighchartsVue.component,
    },
    props: {
        totalUsers: Number,
        applicationsToday: Number,
        applicationsThisWeek: Number,
        applicationsThisMonth: Number,
    },
    data() {
        return {
            applicationChartKey: 0,
            applicationChartOptions: {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Application Overview',
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
                        text: 'Application Count',
                    },
                },
                series: [{
                    name: 'Applications',
                    data: [
                        this.applicationsToday,
                        this.applicationsThisWeek,
                        this.applicationsThisMonth
                    ],
                    color: 'blue',
                }],
            },
            selectedApplicationChartType: 'line',
        };
    },
    methods: {
        switchApplicationGraph(type) {
            this.applicationChartOptions.chart.type = type;
            this.applicationChartOptions.series[0].data = [
                this.applicationsToday,
                this.applicationsThisWeek,
                this.applicationsThisMonth
            ];
            this.applicationChartKey += 1;
        },
    },
    mounted() {
        Highcharts.setOptions({
            colors: ['blue'],
        });
    },
};
</script>

<style scoped>
/* Add scoped styles here */
</style>
