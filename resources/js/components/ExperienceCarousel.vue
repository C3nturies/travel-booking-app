<template>
    <div class="carousel-shell">
        <button class="carousel-btn left" @click="scrollLeft">‹</button>

        <div
            ref="carousel"
            class="experience-wrapper"
            @scroll="handleScroll"
            @mousedown="startDrag"
            @mousemove="onDrag"
            @mouseup="stopDrag"
            @mouseleave="stopDrag"
        >
            <a
                class="experience-card"
                v-for="destination in destinations"
                :key="`${destination.id}-${Math.random()}`"
                :href="`/destinations/${destination.slug}`"
            >
                <img :src="getResponsiveSrc(destination.hero_image, 1600)"
                    :srcset="getSrcSet(destination.hero_image)" 
                    sizes="100vw" :alt="destination.title" 
                    loading="lazy" 
                    decoding="async">

                <div class="experience-gradient"></div>

                <div class="experience-content">
                    <span>{{ destination.type }}</span>

                    <h2>{{ destination.title }}</h2>

                    <div class="experience-info">
                        <p>From €{{ discountedPrice(destination) }}</p>

                        <p>
                            {{ formatDate(destination.available_from) }}
                            -
                            {{ formatDate(destination.available_until) }}
                        </p>
                    </div>

                    <strong>Explore →</strong>
                </div>

            </a>
            <template v-if="isLoading">
                <div v-for="index in skeletonCount" :key="`experience-skeleton-${index}`"
                    class="experience-card experience-skeleton-card">
                    <div class="experience-skeleton-image"></div>

                    <div class="experience-skeleton-content">
                        <div class="experience-skeleton-line short"></div>
                        <div class="experience-skeleton-line medium"></div>
                        <div class="experience-skeleton-line long"></div>
                    </div>
                </div>
            </template>
           <div v-if="!hasMore && destinations.length > 0" class="experience-end-card">
                <span>All experiences loaded</span>
            </div>
        </div>

        <button class="carousel-btn right" type="button" :class="{ 'is-loading': isLoading }" :disabled="isLoading"
            @click="scrollRight">
            <span v-if="!isLoading">›</span>
            <span v-else class="carousel-btn-spinner"></span>
        </button>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import LazyImage from './LazyImage.vue'
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'
import { useRafThrottle } from '../helpers/useRafThrottle'

const props = defineProps({
    initialPaginator: {
        type: Object,
        required: true
    },
    endpoint: {
        type: String,
        default: '/ajax/experience-destinations'
    }
})

const loadInitialData = async () => {
    if (hasLoadedInitialData.value || isLoading.value) {
        return
    }

    isLoading.value = true

    try {
        const response = await fetch(`${props.endpoint}?experience_page=1`, {
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        const result = await response.json()

        destinations.value = [...result.data]
        currentPage.value = result.current_page
        lastPage.value = result.last_page
        hasLoadedInitialData.value = true
    } catch (error) {
        console.error('Initial popular destinations load failed:', error)
    } finally {
        isLoading.value = false
    }
}
const destinations = ref(props.initialPaginator?.data ? [...props.initialPaginator.data] : [])
const currentPage = ref(props.initialPaginator?.current_page || 0)
const lastPage = ref(props.initialPaginator?.last_page || 1)
const hasLoadedInitialData = ref(Boolean(props.initialPaginator?.data?.length))
const carousel = ref(null)
const isLoading = ref(false)
const skeletonCount = 3

const hasMore = computed(() => {
    return currentPage.value < lastPage.value
})

let isDragging = false
let startX = 0
let scrollStart = 0

onMounted(() => {
    loadInitialData()
})

const wait = (ms) => {
    return new Promise(resolve => setTimeout(resolve, ms))
}

const checkIfNearEnd = () => {
    const el = carousel.value

    if (!el || isLoading.value || !hasMore.value) {
        return
    }

    const distanceFromEnd = el.scrollWidth - el.scrollLeft - el.clientWidth

    if (distanceFromEnd < 600) {
        loadMoreExperiences()
    }
}

const handleScroll = useRafThrottle(() => {
    checkIfNearEnd()
})

const scrollLeft = () => {
    carousel.value?.scrollBy({
        left: -520,
        behavior: 'smooth'
    })
}

const scrollRight = async () => {
    if (!carousel.value) {
        return
    }

    const el = carousel.value
    const distanceFromEnd = el.scrollWidth - el.scrollLeft - el.clientWidth

    if (distanceFromEnd < 700 && hasMore.value && !isLoading.value) {
        await loadMoreExperiences()

        setTimeout(() => {
            carousel.value?.scrollBy({
                left: 520,
                behavior: 'smooth'
            })
        }, 100)

        return
    }

    carousel.value.scrollBy({
        left: 520,
        behavior: 'smooth'
    })

    setTimeout(() => {
        checkIfNearEnd()
    }, 350)
}

const startDrag = (event) => {
    if (!carousel.value) return

    isDragging = true
    startX = event.pageX - carousel.value.offsetLeft
    scrollStart = carousel.value.scrollLeft
}

const onDrag = (event) => {
    if (!isDragging || !carousel.value) return

    event.preventDefault()

    const x = event.pageX - carousel.value.offsetLeft
    const walk = (x - startX) * 1.3

    carousel.value.scrollLeft = scrollStart - walk
}

const stopDrag = () => {
    isDragging = false
}

const loadMoreExperiences = async () => {
    if (isLoading.value || !hasMore.value) {
        return
    }

    isLoading.value = true

    const loadingStart = performance.now()

    try {
        const nextPage = currentPage.value + 1

        const response = await fetch(`${props.endpoint}?experience_page=${nextPage}`, {
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        if (!response.ok) {
            throw new Error('Failed to load experience destinations')
        }

        const result = await response.json()

        const elapsed = performance.now() - loadingStart
        const minimumLoadingTime = 500

        if (elapsed < minimumLoadingTime) {
            await wait(minimumLoadingTime - elapsed)
        }

        destinations.value.push(...result.data)
        currentPage.value = result.current_page
        lastPage.value = result.last_page
    } catch (error) {
        console.error('Experience loading error:', error)
    } finally {
        isLoading.value = false
    }
}
const discountedPrice = (destination) => {
    const price = Number(destination.price)

    if (!destination.discount_percent) {
        return price.toFixed(0)
    }

    return (price - price * destination.discount_percent / 100).toFixed(0)
}
const formatDate = (dateValue) => {
    if (!dateValue) return 'Flexible'

    return new Date(dateValue).toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short'
    })
}
</script>
<style scoped>
.carousel-btn:disabled {
    opacity: 0.75;
    cursor: wait;
}

.carousel-btn-spinner {
    width: 22px;
    height: 22px;
    border: 3px solid rgba(15, 23, 42, 0.18);
    border-top-color: rgba(15, 23, 42, 0.75);
    border-radius: 50%;
    animation: experience-spin 0.8s linear infinite;
    display: inline-block;
}

.experience-skeleton-card {
    pointer-events: none;
    background: #e5e7eb;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
}

.experience-skeleton-image {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        #e5e7eb 0%,
        #f3f4f6 50%,
        #e5e7eb 100%
    );
    background-size: 200% 100%;
    animation: experience-skeleton-loading 1.3s infinite;
}

.experience-skeleton-content {
    position: absolute;
    left: 28px;
    right: 28px;
    bottom: 32px;
    z-index: 2;
}

.experience-skeleton-line {
    height: 14px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.75);
    margin-bottom: 12px;
}

.experience-skeleton-line.short {
    width: 35%;
}

.experience-skeleton-line.medium {
    width: 60%;
}

.experience-skeleton-line.long {
    width: 85%;
}

.experience-end-card {
    min-width: 280px;
    height: 600px;
    border-radius: 32px;
    background: rgba(15, 23, 42, 0.06);
    border: 1px solid rgba(15, 23, 42, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #475569;
    font-weight: 600;
    flex-shrink: 0;
}

@keyframes experience-skeleton-loading {
    from {
        background-position: 200% 0;
    }

    to {
        background-position: -200% 0;
    }
}

@keyframes experience-spin {
    to {
        transform: rotate(360deg);
    }
}
</style>