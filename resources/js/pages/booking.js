//import 'bootstrap'
//import 'bootstrap/dist/css/bootstrap.min.css'

import { createApp } from 'vue'

import MainNavbar from '../components/MainNavbarComponent.vue'
import BookingForm from '../components/BookingForm.vue'

const app = createApp({})

app.component('main-navbar', MainNavbar)
app.component('booking-form', BookingForm)

app.mount('#app')