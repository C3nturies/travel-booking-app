<template>
    <div class="row">

        <div
            class="col-md-4 mb-4"
            v-for="destination in destinations"
            :key="destination.id"
        >
            <a
                :href="`/destinations/${destination.slug}`"
                class="package-card-link"
            >
                <div class="card package-card border-0 shadow-lg">

                    <div class="package-image-wrapper">
                        <LazyImage
                            :src="getResponsiveSrc(destination.hero_image, 1600)"
                            :srcset="getSrcSet(destination.hero_image)" sizes="100vw"
                            class="card-img-top"
                            :alt="destination.title"
                            loading="lazy"
                            decoding="async"
                        />

                        <span
                            v-if="destination.discount_percent"
                            class="package-discount"
                        >
                            -{{ destination.discount_percent }}%
                        </span>

                        <span class="package-type">
                            {{ destination.type }}
                        </span>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <h5>{{ destination.title }}</h5>
                                <p class="package-country">
                                    {{ destination.country }}
                                </p>
                            </div>

                            <span class="package-rating">
                                ★ {{ destination.rating }}
                            </span>
                        </div>

                        <p class="package-description">
                            {{ destination.short_description }}
                        </p>

                        <div class="package-dates">
                            <span>Available</span>
                            <strong>
                                {{ formatDate(destination.available_from) }}
                                -
                                {{ formatDate(destination.available_until) }}
                            </strong>
                        </div>

                        <div class="package-price-row">
                            <div>
                                <span>From</span>

                                <div class="d-flex align-items-center gap-2">
                                    <strong class="package-price">
                                        €{{ discountedPrice(destination) }}
                                    </strong>

                                    <small
                                        v-if="destination.discount_percent"
                                        class="old-price"
                                    >
                                        €{{ Number(destination.price).toFixed(0) }}
                                    </small>
                                </div>
                            </div>

                            <span class="view-details">
                                View details →
                            </span>
                        </div>

                    </div>

                </div>
            </a>
        </div>

    </div>
</template>

<script setup>
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'
import LazyImage from './LazyImage.vue'

const props = defineProps({
    initialDestinations: {
        type: Array,
        default: () => []
    }
})

const destinations = props.initialDestinations

const discountedPrice = (destination) => {
    const price = Number(destination.price)

    if (!destination.discount_percent) {
        return price.toFixed(0)
    }

    return (price - (price * destination.discount_percent / 100)).toFixed(0)
}

const formatDate = (dateValue) => {
    if (!dateValue) {
        return 'Flexible'
    }

    return new Date(dateValue).toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
    })
}
</script>

<style scoped>
.package-image-wrapper {
    height: 260px;
    overflow: hidden;
}

.package-image-wrapper :deep(.lazy-image-wrapper) {
    width: 100%;
    height: 100%;
}
</style>