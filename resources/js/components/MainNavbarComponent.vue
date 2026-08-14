<template>
    <nav
        class="navbar navbar-expand-lg fixed-top travel-navbar"
        :class="{ 'travel-navbar-scrolled': isScrolled || isMenuOpen }"
    >
        <div class="container">
            <a class="navbar-brand travel-brand" href="/">
                <span class="brand-mark">T</span>
                <span>TravelLux</span>
            </a>

            <button
                class="navbar-toggler travel-toggler"
                type="button"
                @click="toggleMenu"
                aria-label="Toggle navigation"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div
                class="collapse navbar-collapse"
                :class="{ show: isMenuOpen }"
                id="navbarNav"
            >
                <ul class="navbar-nav ms-auto align-items-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link travel-link" href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link travel-link" href="/destinations">Destinations</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link travel-link" href="/#experiences">Experiences</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link travel-link" href="/#about">About</a>
                    </li>

                    <li class="nav-item my-3 my-lg-0">
                        <div
                            class="nav-date-picker"
                            @click="openDatePicker"
                        >
                            <span>📅</span>

                            <input
                                ref="dateInput"
                                v-model="dateRange"
                                type="text"
                                placeholder="Travel dates"
                                readonly
                                @focus="openDatePicker"
                            >
                        </div>
                    </li>

                    <li class="nav-item ms-lg-4 my-3 my-lg-0">
                        <form class="nav-search" @submit.prevent="submitSearch">
                            <input
                                v-model="search"
                                type="text"
                                placeholder="Search trips"
                            >

                            <button type="submit">⌕</button>
                        </form>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a href="/booking" class="btn nav-book-btn rounded-pill px-4">
                            Book now
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRafThrottle } from '../helpers/useRafThrottle'

const isScrolled = ref(false)
const isMenuOpen = ref(false)
const search = ref('')
const dateInput = ref(null)
const dateRange = ref('')

let flatpickrInstance = null
let isDatePickerLoading = false

const handleScroll = useRafThrottle(() => {
    isScrolled.value = window.scrollY > 40
})

const submitSearch = () => {
    const params = new URLSearchParams()

    if (search.value.trim()) {
        params.append('search', search.value.trim())
    }

    if (dateRange.value) {
        params.append('dates', dateRange.value)
    }

    const queryString = params.toString()

    window.location.href = queryString
        ? `/destinations?${queryString}`
        : '/destinations'
}

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
}

const openDatePicker = async () => {
    if (!dateInput.value) {
        return
    }

    if (flatpickrInstance) {
        flatpickrInstance.open()
        return
    }

    if (isDatePickerLoading) {
        return
    }

    isDatePickerLoading = true

    try {
        await import('flatpickr/dist/flatpickr.min.css')

        const { default: flatpickr } = await import('flatpickr')

        flatpickrInstance = flatpickr(dateInput.value, {
            mode: 'range',
            dateFormat: 'd.m.y',
            minDate: 'today',
            onChange: (selectedDates, dateStr) => {
                dateRange.value = dateStr
            }
        })

        flatpickrInstance.open()
    } catch (error) {
        console.error('Flatpickr lazy load failed:', error)
    } finally {
        isDatePickerLoading = false
    }
}

onMounted(() => {
    handleScroll()

    window.addEventListener('scroll', handleScroll, { passive: true })
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)

    if (flatpickrInstance) {
        flatpickrInstance.destroy()
        flatpickrInstance = null
    }
})
</script>