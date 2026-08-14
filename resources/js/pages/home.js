import $ from 'jquery'
//import 'bootstrap'
//import 'bootstrap/dist/css/bootstrap.min.css'


window.$ = $
window.jQuery = $

import { createApp, defineAsyncComponent } from 'vue'

import MainNavbar from '../components/MainNavbarComponent.vue'
import HeroSlider from '../components/HeroSlider.vue'
import LazyMount from '../components/LazyMount.vue'

/*import LuxuryShowcase from '../components/LuxuryShowcase.vue'
import DestinationCarousel from '../components/DestinationCarousel.vue'
import MinimalCarousel from '../components/MinimalCarousel.vue'
import TravelVideoSection from '../components/TravelVideoSection.vue'
import TravelStats from '../components/TravelStats.vue'
import ExperienceCarousel from '../components/ExperienceCarousel.vue'
import DepthTravelSection from '../components/DepthTravelSection.vue'*/

const asyncComponent = (loader) => {
    return defineAsyncComponent({
        loader,
        delay: 150,
        timeout: 10000,
        onError(error, retry, fail, attempts) {
            if (attempts <= 2) {
                retry()
            } else {
                fail()
            }
        }
    })
}


const app = createApp({})

app.component('main-navbar', MainNavbar)
app.component('hero-slider', HeroSlider)
app.component('lazy-mount', LazyMount)

//app.component('luxury-showcase', LuxuryShowcase)
app.component('luxury-showcase', asyncComponent(() =>
    import('../components/LuxuryShowcase.vue')
))

//app.component('destination-carousel', DestinationCarousel)
app.component('destination-carousel', asyncComponent(() =>
    import('../components/DestinationCarousel.vue')
))

//app.component('minimal-carousel', MinimalCarousel)
app.component('minimal-carousel', asyncComponent(() =>
    import('../components/MinimalCarousel.vue')
))

//app.component('travel-video-section', TravelVideoSection)
app.component('travel-video-section', asyncComponent(() =>
    import('../components/TravelVideoSection.vue')
))

//app.component('travel-stats', TravelStats)
app.component('travel-stats', asyncComponent(() =>
    import('../components/TravelStats.vue')
))

//app.component('experience-carousel', ExperienceCarousel)
app.component('experience-carousel', asyncComponent(() =>
    import('../components/ExperienceCarousel.vue')
))

//app.component('depth-travel-section', DepthTravelSection)
app.component('depth-travel-section', asyncComponent(() =>
    import('../components/DepthTravelSection.vue')
))

app.mount('#app')