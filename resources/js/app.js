//
//import './bootstrap';
import $ from 'jquery'
import 'bootstrap'
//import 'bootstrap/dist/css/bootstrap.min.css'


window.$ = $
window.jQuery = $

import { createApp } from 'vue';

import MainNavbar from './components/MainNavbarComponent.vue'
import HeroSlider from './components/HeroSlider.vue'
import LuxuryShowcase from './components/LuxuryShowcase.vue'
import DestinationCarousel from './components/DestinationCarousel.vue'
import MinimalCarousel from './components/MinimalCarousel.vue'
import ExperienceCarousel from './components/ExperienceCarousel.vue'
import TravelVideoSection from './components/TravelVideoSection.vue'
import TravelStats from './components/TravelStats.vue'
import DestinationListing from './components/DestinationListing.vue'
import DestinationDetails from './components/DestinationDetails.vue'
import BookingForm from './components/BookingForm.vue'
import DepthTravelSection from './components/DepthTravelSection.vue'

//import ExampleComponent from './components/ExampleComponent.vue';
//import BookingForm from './components/BookingForm.vue';

const app = createApp({});

//app.component('example-component', ExampleComponent);
//app.component('booking-form', BookingForm);

app.component('hero-slider', HeroSlider)
app.component('main-navbar', MainNavbar)
app.component('luxury-showcase', LuxuryShowcase)
app.component('destination-carousel', DestinationCarousel)
app.component('minimal-carousel', MinimalCarousel)
app.component('experience-carousel', ExperienceCarousel)
app.component('travel-video-section', TravelVideoSection)
app.component('travel-stats', TravelStats)
app.component('destination-listing', DestinationListing)
app.component('destination-details', DestinationDetails)
app.component('booking-form', BookingForm)
app.component('depth-travel-section', DepthTravelSection)

app.mount('#app');