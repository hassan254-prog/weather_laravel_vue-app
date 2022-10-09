<template>
    <div class="container" style="height: 100vh;">
        <div class="row p-5 h-100">
            <div class="col-12 col-lg-8 pe-lg-5 pb-3 pb-lg-0 d-flex flex-column justify-content-between">
                <div class="row h-25 text-danger">
                    <div class="h-50 d-flex">
                        <router-link to="/">
                            <img src="./assets/logo.png" alt="Logo" class="h-100">
                        </router-link>
                        <div v-if="currentData" class="d-flex h-100 flex-column">
                            <span class="display-5 text-light ms-5 text-uppercase">{{ currentData.name }}</span>
                            <span class="ms-5 text-light opacity-75">{{ moment(currentData.dt).format("YYYY-MM-DD H:m A") }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-100 bg-dark text-light rounded shadow blur d-flex flex-column justify-content-around" style="--mdb-bg-opacity: 0.5;">
                    <BasicData v-if="currentData" :currentData="currentData"></BasicData>
                    <HourlyWeather v-if="hourlyData" :hourlyData="hourlyData"></HourlyWeather>
                </div>
            </div> 
            <div class="col-12 col-lg-4 bg-light text-light rounded shadow blur" style="--mdb-bg-opacity: 0.2;">
                <AdditionalData :currentData="currentData" :dailyData="dailyData"></AdditionalData>
            </div>
        </div>
    </div>
</template>

<script>
import BasicData from './components/BasicData.vue';
import AdditionalData from './components/AdditionalData.vue'
import HourlyWeather from './components/HourlyWeather.vue'
import axios from 'axios';
import moment from 'moment';

export default {
    components: {
        BasicData,
        AdditionalData,
        HourlyWeather,
    },
    data() {
        return {
            currentData: null,
            dailyData: null,
            hourlyData: null,
            moment:moment
        }
    },
    async mounted() {

        if(this.$route.query.city == undefined || this.$route.query.city == null) {
            this.$router.push('/');
        } else {

            let city = this.$route.query.city;
            let errorBool = false;
            
            await axios.get('/api/weather/'+city)
                .then(response => {
                    this.currentData = response.data.data.data;
                })
                .catch(function() {
                     errorBool = true;
            });

            await axios.get('/api/weather_forecast/'+city)
                .then(response => {
                    this.dailyData = response.data.data.data;
                    this.hourlyData = response.data.data.data;
                })
                .catch(function() {
                    errorBool = true;
            });

            // await axios.get('/api/weather_forecast/'+city)
            //     .then(response => {
            //         this.hourlyData = response.data.data.data;
            //     })
            //     .catch(function() {
            //         errorBool = true;
            // });

            if(errorBool) {
                this.$router.push('/');
            }
        }
    },
    methods: {
        getDate(unix) {
            let data = new Date(unix * 1000);
            return data.toLocaleString();
        }
    }
}
</script>

<style scoped>
    .blur {
        backdrop-filter: blur(10px);
    }
</style>