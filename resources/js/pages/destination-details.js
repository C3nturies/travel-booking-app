//import 'bootstrap'
//import 'bootstrap/dist/css/bootstrap.min.css'

import { createApp } from 'vue'

import MainNavbar from '../components/MainNavbarComponent.vue'
import DestinationDetails from '../components/DestinationDetails.vue'

const app = createApp({})

app.component('main-navbar', MainNavbar)
app.component('destination-details', DestinationDetails)

app.mount('#app')