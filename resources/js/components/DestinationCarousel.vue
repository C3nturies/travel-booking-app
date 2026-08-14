<template>
    <div class="carousel-shell">
        <button class="carousel-btn left" @click="scrollLeft">‹</button>

            <div
                ref="carousel"
                class="d-flex overflow-auto gap-4 py-3 carousel-scroll"
                @scroll="handleScroll"
                @mousedown="startDrag"
                @mousemove="onDrag"
                @mouseup="stopDrag"
                @mouseleave="stopDrag"
            >
            <a
                v-for="destination in destinations"
                :key="destination.id"
                :href="`/destinations/${destination.slug}`"
                class="destination-card"
            >
                <img class="hero-image" :src="getResponsiveSrc(destination.hero_image, 1600)"
                    :srcset="getSrcSet(destination.hero_image)" sizes="100vw" :alt="destination.title"
                    decoding="async">

                <div class="destination-hover-layer">
                    <span class="destination-type">{{ destination.type }}</span>

                    <h3>{{ destination.title }}</h3>
                    <p>{{ destination.country }}</p>

                    <div class="destination-hover-meta">
                        <span>€{{ Number(destination.price).toFixed(0) }}</span>

                        <span v-if="destination.discount_percent">
                            -{{ destination.discount_percent }}%
                        </span>
                    </div>

                    <small>
                        {{ formatDate(destination.available_from) }}
                        -
                        {{ formatDate(destination.available_until) }}
                    </small>

                    <strong class="mt-3">View details →</strong>
                </div>
            </a>
            <template v-if="isLoading">
                <div
                    v-for="index in skeletonCount"
                    :key="`skeleton-${index}`"
                    class="destination-card skeleton-card"
                >
                    <div class="skeleton-image"></div>

                    <div class="skeleton-content">
                        <div class="skeleton-line short"></div>
                        <div class="skeleton-line medium"></div>
                        <div class="skeleton-line long"></div>
                    </div>
                </div>
            </template>

            <div v-if="!hasMore && destinations.length > 0" class="carousel-end-card">
                <span>All destinations loaded</span>
            </div>
        </div>

        <button class="carousel-btn right" :class="{ 'is-loading': isLoading }" :disabled="isLoading"
            @click="scrollRight" aria-label="Next destinations">
            <span v-if="!isLoading">›</span>
            <span v-else class="btn-spinner"></span>
        </button>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'
import { useRafThrottle } from '../helpers/useRafThrottle'

const skeletonCount = 3

const props = defineProps({
    initialPaginator: {
        type: Object,
    },
    endpoint: {
        type: String,
        default: '/ajax/popular-destinations'
    }
})


const loadInitialData = async () => {
    if (hasLoadedInitialData.value || isLoading.value) {
        return
    }

    isLoading.value = true

    try {
        const response = await fetch(`${props.endpoint}?page=1`, {
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

const hasMore = computed(() => {
    return currentPage.value < lastPage.value
})

let isDragging = false
let startX = 0
let scrollStart = 0

const checkIfNearEnd = () => {
    const el = carousel.value

    if (!el || isLoading.value || !hasMore.value) {
        return
    }

    const distanceFromEnd = el.scrollWidth - el.scrollLeft - el.clientWidth

    if (distanceFromEnd < 500) {
        loadMoreDestinations()
    }
}

const handleScroll = useRafThrottle(() => {
    checkIfNearEnd()
})

const scrollLeft = () => {
    carousel.value?.scrollBy({
        left: -420,
        behavior: 'smooth'
    })
}

const scrollRight = async () => {
    if (!carousel.value) {
        return
    }

    const el = carousel.value
    const distanceFromEnd = el.scrollWidth - el.scrollLeft - el.clientWidth

    if (distanceFromEnd < 600 && hasMore.value && !isLoading.value) {
        await loadMoreDestinations()

        setTimeout(() => {
            carousel.value?.scrollBy({
                left: 420,
                behavior: 'smooth'
            })
        }, 100)

        return
    }

    carousel.value.scrollBy({
        left: 420,
        behavior: 'smooth'
    })

    setTimeout(() => {
        checkIfNearEnd()
    }, 350)
}

onMounted(() => {
    loadInitialData()
})

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
    const walk = (x - startX) * 1.4

    carousel.value.scrollLeft = scrollStart - walk
}

const stopDrag = () => {
    isDragging = false
}

const formatDate = (dateValue) => {
    if (!dateValue) return 'Flexible'

    return new Date(dateValue).toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short'
    })
}

const wait = (ms) => {
    return new Promise(resolve => setTimeout(resolve, ms))
}

const loadMoreDestinations = async () => {
    if (isLoading.value || !hasMore.value) {
        return
    }

    isLoading.value = true

    const loadingStart = performance.now()

    try {
        const nextPage = currentPage.value + 1

        const response = await fetch(`${props.endpoint}?page=${nextPage}`, {
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        if (!response.ok) {
            throw new Error('Failed to load destinations')
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
        console.error('Destination loading error:', error)
    } finally {
        isLoading.value = false
    }
}
</script>

<style scoped>
.carousel-loading-card,
.carousel-end-card {
    min-width: 260px;
    height: 450px;
    border-radius: 28px;
    background: rgba(15, 23, 42, 0.06);
    border: 1px solid rgba(15, 23, 42, 0.08);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #475569;
    font-weight: 600;
    flex-shrink: 0;
}

.carousel-spinner {
    width: 38px;
    height: 38px;
    border: 4px solid rgba(15, 23, 42, 0.12);
    border-top-color: rgba(15, 23, 42, 0.65);
    border-radius: 50%;
    animation: carousel-spin 0.8s linear infinite;
    margin-bottom: 14px;
}

.carousel-btn:disabled {
    opacity: 0.75;
    cursor: wait;
}

.btn-spinner {
    width: 22px;
    height: 22px;
    border: 3px solid rgba(15, 23, 42, 0.18);
    border-top-color: rgba(15, 23, 42, 0.75);
    border-radius: 50%;
    animation: carousel-spin 0.8s linear infinite;
    display: inline-block;
}

.skeleton-card {
    pointer-events: none;
    background: #e5e7eb;
    overflow: hidden;
    position: relative;
}

.skeleton-image {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        #e5e7eb 0%,
        #f3f4f6 50%,
        #e5e7eb 100%
    );
    background-size: 200% 100%;
    animation: skeleton-loading 1.3s infinite;
}

.skeleton-content {
    position: absolute;
    left: 24px;
    right: 24px;
    bottom: 28px;
    z-index: 2;
}

.skeleton-line {
    height: 14px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.75);
    margin-bottom: 12px;
}

.skeleton-line.short {
    width: 35%;
}

.skeleton-line.medium {
    width: 60%;
}

.skeleton-line.long {
    width: 85%;
}

@keyframes skeleton-loading {
    from {
        background-position: 200% 0;
    }

    to {
        background-position: -200% 0;
    }
}

@keyframes carousel-spin {
    to {
        transform: rotate(360deg);
    }
}
</style>