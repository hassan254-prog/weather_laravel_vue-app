<template>
    <div id="hourlyScroll" class="w-100 h-100 text-nowrap d-flex flex-row h-50">
        <div v-for="val in hourlyData.list" :key="val.dt" class="bg-dark rounded shadow m-3 p-3 pb-0 h-100 hourlyComponent" style="--mdb-bg-opacity: 0.75;">
            <span class="text-muted">{{ moment(val.dt).format("MMM D") }}&nbsp;&nbsp;</span>
            <span> {{ moment(val.dt).format("H:mm A") }}</span>
            <p class="text-center fs-5">{{ Math.round(val.main.temp) }}°C</p>
            <img src="../assets/sun.png" alt="Image" class="w-100">
        </div>
    </div>
</template>

<script>

import moment from 'moment';
export default {
    data () {
    return {
        moment: moment
        }
    },
    props: {
        hourlyData: Object
    },
    computed: {
        test() {
            let val = ['21:00', '22:00', '23:00', '00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00']
            return val;
        }
    }
}
</script>

<style scoped>

#hourlyScroll {
    overflow-x: scroll;
    overflow-y: hidden;
}

.hourlyComponent {
    position: relative;
    top: 0;
    transition: top ease 0.5s;
}

.hourlyComponent:hover {
    top: -10px;
}

::-webkit-scrollbar {
  width: 1px;
}

/* Track */
::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0); 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 2px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

</style>