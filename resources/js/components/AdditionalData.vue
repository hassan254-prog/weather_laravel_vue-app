<template>
    <div v-if="currentData" class="h-100 w-100 p-3 d-flex flex-column justify-content-between">
        <!-- Search bar -->
        <div>
            <!-- <div class="input-group rounded w-100">
                <input type="search" class="form-control rounded" placeholder="Wpisz nazwę miasta..." aria-label="Search" aria-describedby="search" />
                <span class="input-group-text border-0 text-warning" id="search">
                    <i class="fas fa-search"></i>
                </span>
            </div> -->
            <hr>

            <!-- Additional weather data -->
            <div class="row">
                <div class="col-6 text-start text-light opacity-75">
                    <p>Perceptibly</p>
                    <p>Humidity</p>
                    <p>Pressure</p>
                    <p>Wind speed</p>
                    <p>Cloudy</p>
                </div>
                <div class="col-6 text-end">
                    <p>{{ Math.round(currentData.main.feels_like) }}°C</p>
                    <p>{{ Math.round(currentData.main.humidity) }}%</p>
                    <p>{{ currentData.main.pressure }}mbar</p>
                    <p>{{ parseFloat(currentData.wind.speed * 3.6).toFixed(1) }} km/h</p>
                    <p>{{ currentData.clouds.all }}%</p>
                </div>
                <hr>
            </div>
        </div>

        
        <!-- Sunrise and sunset data -->
        <div>

            <!-- 5 days weather graph -->
            <div v-if="dailyData" class="row">
                <WeekChart :data="dailyData"></WeekChart>
            </div>

            <hr>
            <div class="row">
                <div class="col-6 text-start">
                    {{  moment(currentData.sys.sunrise).format("H:m A") }}
                </div>
                <div class="col-6 text-end">
                    {{  moment(currentData.sys.sunset).format("H:m A") }}
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" :style="{ width: progressPercent + '%'}"></div>
            </div>
            <div class="row">
                <div class="col-6 text-start">
                    Sunrise
                </div>
                <div class="col-6 text-end">
                    Sunset
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import WeekChart from './WeekChart.vue'
import moment from "moment";

export default {
    components: {
        WeekChart,
    },
    data () {
    return {
        moment: moment
        }
    },
    props: {
        currentData: Object,
        dailyData: Object
    },
    computed: {
        progressPercent() {
            var now = moment();
            var sunset = moment(this.currentData.sys.sunset);
            let currentMinutes =  (now.hour() * 60) + now.minutes();
            let sunsetMinutes = (sunset.hour() * 60) + sunset.minutes();
            return Math.round(currentMinutes / sunsetMinutes * 100);
        }
    }
}
</script>