<template>
    <section
        ref="sectionRef"
        class="depth-section"
    >
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <span class="section-subtitle">TRAVEL WITH PURPOSE</span>

                    <h2 class="depth-title">
                        Feel closer to every destination
                    </h2>

                    <p class="depth-text">
                        We create journeys that feel personal, immersive and carefully designed —
                        from peaceful landscapes to unforgettable shared moments.
                    </p>

                    <a href="/destinations" class="btn btn-warning rounded-pill px-5 py-3">
                        Explore journeys
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="depth-visual">
                        <img
                            class="depth-bg"
                            :style="{ transform: `scale(${bgScale})` }"
                            :src="getResponsiveSrc(backgroundImage, 960)"
                            :srcset="getSrcSet(backgroundImage)"
                            sizes="(max-width: 992px) 92vw, 50vw"
                            alt="Travel landscape"
                            loading="lazy"
                            decoding="async"
                        >

                        <img
                            class="depth-people"
                            :style="{ transform: `translateY(${peopleY}px) scale(${peopleScale})` }"
                            :src="getResponsiveSrc(peopleImage, 960)"
                            :srcset="getSrcSet(peopleImage)"
                            sizes="(max-width: 992px) 72vw, 32vw"
                            alt="Travelers"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRafThrottle } from '../helpers/useRafThrottle'
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'

const sectionRef = ref(null)

const backgroundImage = '/images/misc/road.jpg'
const peopleImage = '/images/misc/travelers.png'

const bgScale = ref(1.12)
const peopleScale = ref(1)
const peopleY = ref(0)

const updateDepthEffect = () => {
    const section = sectionRef.value

    if (!section) {
        return
    }

    const rect = section.getBoundingClientRect()
    const windowHeight = window.innerHeight

    const progress = Math.min(
        Math.max((windowHeight - rect.top) / (windowHeight + rect.height), 0),
        1
    )

    bgScale.value = 1.16 - progress * 0.10
    peopleScale.value = 1.04 + progress * 0.10
    peopleY.value = -progress * 35
}

const handleScroll = useRafThrottle(updateDepthEffect)

onMounted(() => {
    window.addEventListener('scroll', handleScroll, {
        passive: true
    })

    updateDepthEffect()
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>