<template>
    <section class="luxury-showcase-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="showcase-image-wrapper">
                        <img
                            :src="getResponsiveSrc(showcaseImage, 960)"
                            :srcset="getSrcSet(showcaseImage)"
                            sizes="(max-width: 992px) 92vw, 50vw"
                            class="showcase-image floating-image"
                            alt="Luxury travel road"
                            loading="lazy"
                            decoding="async"
                        >

                        <div class="floating-card glass-card">
                            <span>120+ destinations</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <span class="section-subtitle">
                        PREMIUM TRAVEL EXPERIENCE
                    </span>

                    <h2 class="showcase-title">
                        Curated luxury adventures around the world
                    </h2>

                    <p class="showcase-description">
                        Discover unforgettable journeys designed for travelers seeking
                        immersive experiences, breathtaking landscapes and seamless luxury.
                    </p>

                    <div class="showcase-features">
                        <div
                            v-for="feature in features"
                            :key="feature"
                            class="feature-item"
                        >
                            <div class="feature-icon"></div>
                            {{ feature }}
                        </div>
                    </div>

                    <button class="btn btn-warning rounded-pill px-5 py-3 mt-4">
                        Discover more
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'

const showcaseImage = '/images/misc/road.jpg'

const features = [
    'Personalized travel planning',
    'Exclusive luxury accommodations',
    'Premium global destinations',
]
</script>