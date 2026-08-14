<template>
    <section class="hero-section" v-if="hasSlides">
        <transition name="fade" mode="out-in">
            <div :key="currentSlide.id" class="hero-slide">
                <div class="hero-overlay"></div>

                <img
                    class="hero-image"
                    :src="getHeroSrc(currentSlide)"
                    :srcset="getHeroSrcSet(currentSlide)"
                    sizes="100vw"
                    :alt="currentSlide.title"
                    decoding="async"
                    loading="eager"
                    @error="handleImageError"
                >

                <div class="hero-content">
                    <h1>
                        {{ currentSlide.title }}
                    </h1>

                    <div class="hero-price-badge">
                        From €{{ Number(currentSlide.price).toFixed(0) }}
                    </div>

                    <p>
                        {{ currentSlide.short_description }}
                    </p>

                    <a
                        :href="`/destinations/${currentSlide.slug}`"
                        class="btn btn-warning btn-lg rounded-pill px-5"
                    >
                        Explore destination
                    </a>
                </div>
            </div>
        </transition>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { getSrcSet, getResponsiveSrc } from '../helpers/imageHelpers'

const props = defineProps({
    slides: {
        type: Array,
        default: () => []
    },

    initialSlide: {
        type: Object,
        default: null
    }
})

const currentIndex = ref(0)
let intervalId = null

const hasSlides = computed(() => {
    return props.slides.length > 0
})

const currentSlide = computed(() => {
    return props.slides[currentIndex.value]
})

const getHeroImage = (slide) => {
    return slide?.hero_image || slide?.optimized_hero_image || ''
}

const getHeroSrc = (slide) => {
    const image = getHeroImage(slide)

    if (!image) {
        return ''
    }

    return getResponsiveSrc(image, 1600)
}

const getHeroSrcSet = (slide) => {
    const image = getHeroImage(slide)

    if (!image) {
        return ''
    }

    return getSrcSet(image)
}

const handleImageError = (event) => {
    const image = getHeroImage(currentSlide.value)

    if (!image || event.target.dataset.fallbackApplied === 'true') {
        return
    }

    event.target.dataset.fallbackApplied = 'true'
    event.target.removeAttribute('srcset')
    event.target.src = image
}

const setInitialIndex = () => {
    if (!props.initialSlide) {
        currentIndex.value = 0
        return
    }

    const index = props.slides.findIndex(slide => {
        return slide.id === props.initialSlide.id
    })

    currentIndex.value = index >= 0 ? index : 0
}

const startSlider = () => {
    if (intervalId || props.slides.length <= 1) {
        return
    }

    intervalId = setInterval(() => {
        currentIndex.value =
            (currentIndex.value + 1) % props.slides.length
    }, 7000)
}

onMounted(() => {
    if (!hasSlides.value) {
        return
    }

    setInitialIndex()

    window.addEventListener('load', () => {
        setTimeout(() => {
            startSlider()
        }, 3000)
    }, { once: true })
})

onUnmounted(() => {
    if (intervalId) {
        clearInterval(intervalId)
    }
})
</script>
