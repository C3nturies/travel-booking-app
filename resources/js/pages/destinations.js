//import 'bootstrap'
//import 'bootstrap/dist/css/bootstrap.min.css'

import { createApp } from 'vue'

import MainNavbar from '../components/MainNavbarComponent.vue'
import DestinationListing from '../components/DestinationListing.vue'

const app = createApp({})

app.component('main-navbar', MainNavbar)
app.component('destination-listing', DestinationListing)

app.mount('#app')