<template>
    <main class="booking-page">
        <section class="booking-content">
            <div class="container">
                <div class="row g-5">

                    <div class="col-lg-8">

                        <div class="booking-panel">

                            <div class="booking-steps">
                                <div
                                    v-for="step in steps"
                                    :key="step.number"
                                    class="booking-step"
                                    :class="{ active: currentStep === step.number, completed: currentStep > step.number }"
                                >
                                    <span>{{ step.number }}</span>
                                    <p>{{ step.label }}</p>
                                </div>
                            </div>

                            <form @submit.prevent="submitBooking($event)">

                                <!-- STEP 1 -->
                                <div v-if="currentStep === 1" class="form-step">
                                    <h2>Trip details</h2>

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label>Destination</label>
                                            <select v-model="form.destination" class="form-select">
                                                <option value="">Choose destination</option>
                                                <option
                                                    v-for="destination in destinations"
                                                    :key="destination.slug"
                                                    :value="destination.slug"
                                                >
                                                    {{ destination.title }}
                                                </option>
                                            </select>
                                            <small v-if="errors.destination">{{ errors.destination }}</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Departure date</label>
                                            <input v-model="form.date" type="date" class="form-control">
                                            <small v-if="errors.date">{{ errors.date }}</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Adults</label>
                                            <input v-model.number="form.adults" type="number" min="1" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Children</label>
                                            <input v-model.number="form.children" type="number" min="0" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- STEP 2 -->
                                <div v-if="currentStep === 2" class="form-step">
                                    <h2>Traveler information</h2>

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label>First name</label>
                                            <input v-model="form.firstName" type="text" class="form-control">
                                            <small v-if="errors.firstName">{{ errors.firstName }}</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Last name</label>
                                            <input v-model="form.lastName" type="text" class="form-control">
                                            <small v-if="errors.lastName">{{ errors.lastName }}</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input v-model="form.email" type="email" class="form-control">
                                            <small v-if="errors.email">{{ errors.email }}</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Phone</label>
                                            <input v-model="form.phone" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- STEP 3 -->
                                <div v-if="currentStep === 3" class="form-step">
                                    <h2>Travel extras</h2>

                                    <div class="extras-grid">
                                        <label
                                            v-for="extra in extras"
                                            :key="extra.id"
                                            class="extra-card"
                                            :class="{ selected: form.extras.includes(extra.id) }"
                                        >
                                            <input
                                                v-model="form.extras"
                                                type="checkbox"
                                                :value="extra.id"
                                            >

                                            <div>
                                                <h4>{{ extra.title }}</h4>
                                                <p>{{ extra.description }}</p>
                                                <strong>+ €{{ extra.price }}</strong>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="mt-4">
                                        <label>Special requests</label>
                                        <textarea
                                            v-model="form.requests"
                                            class="form-control"
                                            rows="5"
                                            placeholder="Write any special requests..."
                                        ></textarea>
                                    </div>
                                </div>

                                <!-- STEP 4 -->
                                <div v-if="currentStep === 4" class="form-step">
                                    <h2>Booking summary</h2>

                                    <div class="summary-box">
                                        <div>
                                            <span>Destination</span>
                                            <strong>{{ selectedDestination?.title || '-' }}</strong>
                                        </div>

                                        <div>
                                            <span>Date</span>
                                            <strong>{{ form.date || '-' }}</strong>
                                        </div>

                                        <div>
                                            <span>Travelers</span>
                                            <strong>{{ totalTravelers }}</strong>
                                        </div>

                                        <div>
                                            <span>Selected extras</span>
                                            <strong>{{ selectedExtras.length }}</strong>
                                        </div>

                                        <div class="summary-total">
                                            <span>Total price</span>
                                            <strong>€{{ totalPrice }}</strong>
                                        </div>
                                    </div>

                                    <div v-if="submitted" class="booking-success">
                                        Booking request submitted successfully.
                                    </div>
                                </div>

                                <div class="booking-actions">
                                    <button
                                        type="button"
                                        class="btn btn-outline-light rounded-pill px-5"
                                        :disabled="currentStep === 1"
                                        @click="previousStep"
                                    >
                                        Back
                                    </button>

                                    <button
                                        v-if="currentStep < 4"
                                        type="button"
                                        class="btn btn-warning rounded-pill px-5"
                                        @click="nextStep"
                                    >
                                        Next
                                    </button>

                                    <button
                                        v-else
                                        type="submit"
                                        class="btn btn-warning rounded-pill px-5"
                                        :disabled="isSubmitting"
                                    >
                                        <span v-if="!isSubmitting">Submit booking</span>
                                        <span v-else>Submitting...</span>
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                    <div class="col-lg-4">
                        <aside class="booking-summary-card">
                            <h3>Live price summary</h3>

                            <p class="summary-destination">
                                {{ selectedDestination?.title || 'No destination selected' }}
                            </p>

                            <div class="summary-line">
                                <span>Base price</span>
                                <strong>€{{ basePrice }}</strong>
                            </div>

                            <div class="summary-line">
                                <span>Travelers</span>
                                <strong>{{ totalTravelers }}</strong>
                            </div>

                            <div
                                v-for="extra in selectedExtras"
                                :key="extra.id"
                                class="summary-line"
                            >
                                <span>{{ extra.title }}</span>
                                <strong>+ €{{ extra.price }}</strong>
                            </div>

                            <div class="summary-final">
                                <span>Total</span>
                                <strong>€{{ totalPrice }}</strong>
                            </div>
                        </aside>
                    </div>

                </div>
            </div>
        </section>

    </main>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'

const props = defineProps({
    slug: String,
    
    initialDestinations: {
        type: Array,
        default: () => []
    }
})

const currentStep = ref(1)
const submitted = ref(false)
const isSubmitting = ref(false)

const steps = [
    { number: 1, label: 'Trip' },
    { number: 2, label: 'Traveler' },
    { number: 3, label: 'Extras' },
    { number: 4, label: 'Summary' },
]

const destinations = props.initialDestinations

if (props.slug && !destinations.some(destination => destination.slug === props.slug)) {
    console.warn('Selected booking slug does not exist:', props.slug)
}

const destinations_static = [
    { slug: 'bali-paradise-escape', title: 'Bali Paradise Escape', price: 1890 },
    { slug: 'santorini-luxury-stay', title: 'Santorini Luxury Stay', price: 2490 },
    { slug: 'tokyo-urban-discovery', title: 'Tokyo Urban Discovery', price: 2190 },
    { slug: 'iceland-northern-lights', title: 'Iceland Northern Lights', price: 2790 },
    { slug: 'swiss-alps-adventure', title: 'Swiss Alps Adventure', price: 3190 },
    { slug: 'dubai-premium-experience', title: 'Dubai Premium Experience', price: 3990 },
]

const extras = [
    {
        id: 'transfer',
        title: 'Private airport transfer',
        description: 'Luxury private transfer from airport to hotel.',
        price: 120,
    },
    {
        id: 'insurance',
        title: 'Travel insurance',
        description: 'Additional travel protection for your journey.',
        price: 80,
    },
    {
        id: 'premium-room',
        title: 'Premium accommodation upgrade',
        description: 'Upgrade your room or villa to premium category.',
        price: 450,
    },
    {
        id: 'guide',
        title: 'Private local guide',
        description: 'Personal local guide for selected activities.',
        price: 250,
    },
]

const form = reactive({
    destination: props.slug || '',
    date: '',
    adults: 1,
    children: 0,
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    extras: [],
    requests: '',
})

const errors = reactive({})

const selectedDestination = computed(() => {
    return destinations.find(destination => destination.slug === form.destination)
})

const selectedExtras = computed(() => {
    return extras.filter(extra => form.extras.includes(extra.id))
})

const totalTravelers = computed(() => {
    return Number(form.adults || 0) + Number(form.children || 0)
})

const basePrice = computed(() => {
    return selectedDestination.value
        ? selectedDestination.value.price * totalTravelers.value
        : 0
})

const extrasPrice = computed(() => {
    return selectedExtras.value.reduce((sum, extra) => sum + extra.price, 0)
})

const totalPrice = computed(() => {
    return basePrice.value + extrasPrice.value
})

const clearErrors = () => {
    Object.keys(errors).forEach(key => delete errors[key])
}

const validateStep = () => {
    clearErrors()

    if (currentStep.value === 1) {
        if (!form.destination) {
            errors.destination = 'Please choose a destination.'
        }

        if (!form.date) {
            errors.date = 'Please choose a departure date.'
        }
    }

    if (currentStep.value === 2) {
        if (!form.firstName) {
            errors.firstName = 'First name is required.'
        }

        if (!form.lastName) {
            errors.lastName = 'Last name is required.'
        }

        if (!form.email || !form.email.includes('@')) {
            errors.email = 'Valid email is required.'
        }
    }

    return Object.keys(errors).length === 0
}

const nextStep = () => {
    if (!validateStep()) {
        return
    }

    currentStep.value++
}

const previousStep = () => {
    currentStep.value--
}

const submitBooking = async () => {
    submitted.value = false

    if (isSubmitting.value) {
        return
    }

    isSubmitting.value = true

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')

    const payload = {
        destination_slug: form.destination,
        departure_date: form.date,
        adults: form.adults,
        children: form.children,
        first_name: form.firstName,
        last_name: form.lastName,
        email: form.email,
        phone: form.phone,
        extras: form.extras,
        requests: form.requests,
        total_price: totalPrice.value,
    }

    try {
        const response = await fetch('/bookings', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(payload),
        })

        if (!response.ok) {
            const errorResponse = await response.json().catch(() => null)

            console.error('Booking submit error:', errorResponse)

            alert('Booking could not be saved. Check console for details.')
            return
        }

        submitted.value = true
    } catch (error) {
        console.error('Booking request failed:', error)

        alert('Booking could not be saved. Check console for details.')
    } finally {
        isSubmitting.value = false
    }
}
</script>