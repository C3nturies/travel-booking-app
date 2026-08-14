<template>
    <main class="details-page">

        <section class="details-content">
            <div class="container">
                <div class="row g-5">

                    <div class="col-lg-8">

                        <section class="details-section">
                            <h2>About this trip</h2>
                            <p>{{ destination.description }}</p>
                        </section>

                        <DestinationGallery :images="galleryImages" :destination-title="destination.title" />

                        <section class="details-section">
                            <h2>Trip highlights</h2>

                            <div class="highlight-grid">
                                <div
                                    v-for="highlight in highlights"
                                    :key="highlight"
                                    class="highlight-card"
                                >
                                    {{ highlight }}
                                </div>
                            </div>
                        </section>

                        <section class="details-section">
                            <h2>Itinerary</h2>

                            <div class="itinerary-list">
                                <div
                                    v-for="day in itinerary"
                                    :key="day.day"
                                    class="itinerary-item"
                                >
                                    <span>Day {{ day.day }}</span>

                                    <div>
                                        <h4>{{ day.title }}</h4>
                                        <p>{{ day.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section
                            v-if="destination.reviews && destination.reviews.length > 0"
                            class="details-section"
                        >
                            <h2>Traveler reviews</h2>

                            <div class="review-list">
                                <div
                                    v-for="review in destination.reviews"
                                    :key="review.id"
                                    class="review-card"
                                >
                                    <strong>{{ review.reviewer_name }}</strong>
                                    <span>★ {{ formatRating(review.rating) }}</span>
                                    <p>{{ review.comment }}</p>
                                </div>
                            </div>
                        </section>

                    </div>

                    <div class="col-lg-4">
                        <aside class="booking-card">
                            <span class="price">€{{ formatPrice(destination.price) }}</span>
                            <p>per person</p>

                            <div class="booking-info">
                                <div>
                                    <strong>{{ destination.days }}</strong>
                                    <span>days</span>
                                </div>

                                <div>
                                    <strong>{{ formatRating(destination.rating) }}</strong>
                                    <span>rating</span>
                                </div>
                            </div>

                            <a
                                :href="`/booking/${destination.slug}`"
                                class="btn btn-warning w-100 rounded-pill py-3 mt-4"
                            >
                                Book this trip
                            </a>

                            <button class="btn btn-outline-light w-100 rounded-pill py-3 mt-3">
                                Ask for details
                            </button>
                        </aside>
                    </div>

                </div>
            </div>
        </section>

    </main>
</template>

<script setup>
import { computed, ref } from 'vue'
import DestinationGallery from './DestinationGallery.vue'

const props = defineProps({
    initialDestination: {
        type: Object,
        required: true
    }
})

const destination = props.initialDestination

const visibleGalleryCount = ref(4)

const galleryImages = computed(() => {
    return destination.images || []
})

const hasGalleryImages = computed(() => {
    return galleryImages.value.length > 0
})

const visibleGalleryImages = computed(() => {
    return galleryImages.value.slice(0, visibleGalleryCount.value)
})

const showMoreGalleryImages = () => {
    visibleGalleryCount.value += 4
}

const formatPrice = (price) => {
    return Number(price || 0).toFixed(0)
}

const formatRating = (rating) => {
    return Number(rating || 0).toFixed(1)
}

const highlights = [
    'Private accommodation',
    'Guided cultural tours',
    'Luxury travel experience',
    'Airport transfer',
    'Local food tasting',
    'Curated activities'
]

const itinerary = [
    {
        day: 1,
        title: 'Arrival',
        description: 'Private transfer and hotel check-in.'
    },
    {
        day: 2,
        title: 'Local experience',
        description: 'Guided tour and cultural activities.'
    },
    {
        day: 3,
        title: 'Relaxation',
        description: 'Free time, premium accommodation and optional extras.'
    },
    {
        day: 4,
        title: 'Departure',
        description: 'Breakfast and transfer to the airport.'
    }
]
</script>