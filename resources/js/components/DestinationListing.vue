<template>
    <section class="destinations-page">
        <div class="container">

            <div class="filters-panel">
                <div class="row g-3 align-items-end">

                    <div class="col-lg-4">
                        <label>Search destination</label>

                        <input
                            v-model="search"
                            type="text"
                            class="form-control"
                            placeholder="Search Bali, Paris, Iceland..."
                            @input="refreshWithDebounce"
                        >
                    </div>

                    <div class="col-lg-3">
                        <label>Travel type</label>

                        <select
                            v-model="selectedType"
                            class="form-select"
                            @change="refreshDestinations"
                        >
                            <option value="all">All types</option>

                            <option
                                v-for="type in types"
                                :key="type"
                                :value="type"
                            >
                                {{ type }}
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label>Sort by</label>

                        <select
                            v-model="sortBy"
                            class="form-select"
                            @change="refreshDestinations"
                        >
                            <option value="popular">Most popular</option>
                            <option value="rating">Highest rated</option>
                            <option value="price-low">Price: low to high</option>
                            <option value="price-high">Price: high to low</option>
                            <option value="duration">Duration</option>
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <button
                            class="btn btn-warning w-100"
                            type="button"
                            @click="resetFilters"
                        >
                            Reset
                        </button>
                    </div>

                </div>
            </div>

            <div class="results-info">
                Showing {{ destinations.length }} of {{ totalDestinations }} destinations
            </div>

            <div
                v-if="isRefreshing"
                class="row g-4"
            >
                <div
                    v-for="index in skeletonCount"
                    :key="`refresh-skeleton-${index}`"
                    class="col-md-6 col-xl-4"
                >
                    <div class="destination-list-card skeleton-list-card">
                        <div class="skeleton-image"></div>

                        <div class="destination-card-body">
                            <div class="skeleton-line medium"></div>
                            <div class="skeleton-line short"></div>
                            <div class="skeleton-line long"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                v-else
                class="row g-4"
            >
                <div
                    v-for="destination in destinations"
                    :key="destination.id"
                    class="col-md-6 col-xl-4"
                >
                    <div class="destination-list-card">

                        <div class="destination-image-wrapper">
                            <LazyImage
                                :src="getResponsiveSrc(destination.hero_image, 960)"
                                :srcset="getSrcSet(destination.hero_image)"
                                sizes="(max-width: 576px) 92vw, (max-width: 992px) 45vw, 33vw"
                                :alt="destination.title"
                                image-class="hero-image"
                                root-margin="400px"
                            />

                            <span class="destination-badge">
                                {{ destination.type }}
                            </span>
                        </div>

                        <div class="destination-card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3>{{ destination.title }}</h3>
                                    <p>{{ destination.country }}</p>
                                </div>

                                <span class="rating">
                                    ★ {{ formatRating(destination.rating) }}
                                </span>
                            </div>

                            <p class="destination-description">
                                {{ destination.short_description }}
                            </p>

                            <div class="destination-meta">
                                <span>{{ destination.days }} days</span>
                                <span>From €{{ formatPrice(destination.price) }}</span>
                            </div>

                            <a
                                :href="`/destinations/${destination.slug}`"
                                class="btn btn-outline-warning w-100 mt-3"
                            >
                                View details
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div
                v-if="!isRefreshing && destinations.length === 0"
                class="empty-destinations"
            >
                No destinations found.
            </div>

            <div
                v-if="isLoadingMore"
                class="row g-4 mt-2"
            >
                <div
                    v-for="index in 3"
                    :key="`load-more-skeleton-${index}`"
                    class="col-md-6 col-xl-4"
                >
                    <div class="destination-list-card skeleton-list-card">
                        <div class="skeleton-image"></div>

                        <div class="destination-card-body">
                            <div class="skeleton-line medium"></div>
                            <div class="skeleton-line short"></div>
                            <div class="skeleton-line long"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="text-center mt-5"
                v-if="!isRefreshing"
            >
                <button
                    v-if="hasMore"
                    class="btn btn-warning rounded-pill px-5 py-3"
                    type="button"
                    :disabled="isLoadingMore"
                    @click="loadMore"
                >
                    <span v-if="!isLoadingMore">
                        Load more destinations
                    </span>

                    <span v-else>
                        Loading destinations...
                    </span>
                </button>

                <p
                    v-else-if="destinations.length > 0"
                    class="all-loaded-text"
                >
                    All destinations loaded.
                </p>
            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, computed, onBeforeUnmount } from 'vue'
import LazyImage from './LazyImage.vue'
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'

const props = defineProps({
    initialPaginator: {
        type: Object,
        required: true
    },

    types: {
        type: Array,
        default: () => []
    },

    initialFilters: {
        type: Object,
        default: () => ({
            search: '',
            type: 'all',
            sort: 'popular'
        })
    },

    ajaxEndpoint: {
        type: String,
        default: '/ajax/destinations'
    }
})

const getInitialData = () => {
    if (Array.isArray(props.initialPaginator)) {
        return props.initialPaginator
    }

    return props.initialPaginator.data || []
}

const destinations = ref([...getInitialData()])

const currentPage = ref(
    Array.isArray(props.initialPaginator)
        ? 1
        : props.initialPaginator.current_page || 1
)

const lastPage = ref(
    Array.isArray(props.initialPaginator)
        ? 1
        : props.initialPaginator.last_page || 1
)

const totalDestinations = ref(
    Array.isArray(props.initialPaginator)
        ? props.initialPaginator.length
        : props.initialPaginator.total || destinations.value.length
)

const search = ref(props.initialFilters.search || '')
const selectedType = ref(props.initialFilters.type || 'all')
const sortBy = ref(props.initialFilters.sort || 'popular')

const isRefreshing = ref(false)
const isLoadingMore = ref(false)

const skeletonCount = 9

let debounceTimer = null

const hasMore = computed(() => {
    return currentPage.value < lastPage.value
})

const wait = (ms) => {
    return new Promise(resolve => setTimeout(resolve, ms))
}

const formatPrice = (price) => {
    return Number(price || 0).toFixed(0)
}

const formatRating = (rating) => {
    return Number(rating || 0).toFixed(1)
}

const buildUrl = (page = 1) => {
    const params = new URLSearchParams()

    params.set('page', page)

    if (search.value.trim()) {
        params.set('search', search.value.trim())
    }

    if (selectedType.value && selectedType.value !== 'all') {
        params.set('type', selectedType.value)
    }

    if (sortBy.value) {
        params.set('sort', sortBy.value)
    }

    return `${props.ajaxEndpoint}?${params.toString()}`
}

const updateBrowserUrl = () => {
    const params = new URLSearchParams()

    if (search.value.trim()) {
        params.set('search', search.value.trim())
    }

    if (selectedType.value && selectedType.value !== 'all') {
        params.set('type', selectedType.value)
    }

    if (sortBy.value && sortBy.value !== 'popular') {
        params.set('sort', sortBy.value)
    }

    const queryString = params.toString()

    const newUrl = queryString
        ? `/destinations?${queryString}`
        : '/destinations'

    window.history.replaceState({}, '', newUrl)
}

const fetchDestinations = async (page = 1, append = false) => {
    if (append) {
        isLoadingMore.value = true
    } else {
        isRefreshing.value = true
    }

    const loadingStart = performance.now()

    try {
        const response = await fetch(buildUrl(page), {
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        if (!response.ok) {
            throw new Error('Failed to fetch destinations')
        }

        const result = await response.json()

        const elapsed = performance.now() - loadingStart
        const minimumLoadingTime = append ? 350 : 250

        if (elapsed < minimumLoadingTime) {
            await wait(minimumLoadingTime - elapsed)
        }

        if (append) {
            destinations.value.push(...result.data)
        } else {
            destinations.value = [...result.data]
        }

        currentPage.value = result.current_page
        lastPage.value = result.last_page
        totalDestinations.value = result.total

        updateBrowserUrl()
    } catch (error) {
        console.error('Destination listing error:', error)
    } finally {
        isRefreshing.value = false
        isLoadingMore.value = false
    }
}

const refreshDestinations = () => {
    fetchDestinations(1, false)
}

const refreshWithDebounce = () => {
    clearTimeout(debounceTimer)

    debounceTimer = setTimeout(() => {
        refreshDestinations()
    }, 350)
}

const loadMore = () => {
    if (isLoadingMore.value || !hasMore.value) {
        return
    }

    fetchDestinations(currentPage.value + 1, true)
}

const resetFilters = () => {
    search.value = ''
    selectedType.value = 'all'
    sortBy.value = 'popular'

    fetchDestinations(1, false)
}

onBeforeUnmount(() => {
    clearTimeout(debounceTimer)
})
</script>

<style scoped>
.destination-image-wrapper :deep(.lazy-image-wrapper) {
    width: 100%;
    height: 100%;
}

.skeleton-list-card {
    min-height: 470px;
    pointer-events: none;
    overflow: hidden;
}

.skeleton-image {
    height: 280px;
    background: linear-gradient(
        90deg,
        #e5e7eb 0%,
        #f3f4f6 50%,
        #e5e7eb 100%
    );
    background-size: 200% 100%;
    animation: listing-skeleton-loading 1.3s infinite;
}

.skeleton-line {
    height: 14px;
    border-radius: 999px;
    background: #e2e8f0;
    margin-bottom: 14px;
}

.skeleton-line.short {
    width: 40%;
}

.skeleton-line.medium {
    width: 65%;
}

.skeleton-line.long {
    width: 90%;
}

.empty-destinations,
.all-loaded-text {
    color: #64748b;
    font-weight: 700;
}

@keyframes listing-skeleton-loading {
    from {
        background-position: 200% 0;
    }

    to {
        background-position: -200% 0;
    }
}
</style>