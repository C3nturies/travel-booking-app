<template>
    <section
        ref="videoSection"
        class="travel-video-section"
    >
        <div class="container">
            <div class="row align-items-center">

                <!-- TEXT -->
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <span class="video-subtitle">
                        PREMIUM EXPERIENCES
                    </span>

                    <h2 class="video-title">
                        Discover places that feel unreal
                    </h2>

                    <p class="video-description">
                        Explore breathtaking destinations with curated luxury experiences,
                        unforgettable adventures and cinematic landscapes around the globe.
                    </p>

                    <button class="btn btn-warning rounded-pill px-5 py-3">
                        Explore more
                    </button>
                </div>

                <!-- VIDEO -->
                <div class="col-lg-7">
                    <div class="video-wrapper">

                        <!-- Placeholder prije učitavanja videa -->
                        <div
                            v-if="!shouldLoadVideo"
                            class="video-placeholder"
                        >
                            <img
                                :src="posterSrc"
                                alt="Travel video preview"
                                class="video-poster"
                                loading="lazy"
                                decoding="async"
                            >

                            <div class="video-placeholder-overlay">
                                <div class="video-loader">
                                    <div class="video-spinner"></div>
                                    <span>Video loading soon</span>
                                </div>
                            </div>
                        </div>

                        <!-- Video se kreira tek kada sekcija dođe blizu viewporta -->
                        <video
                            v-if="shouldLoadVideo"
                            ref="videoElement"
                            muted
                            loop
                            playsinline
                            preload="none"
                            :poster="posterSrc"
                            class="travel-video"
                        >
                            <source
                                :src="videoSrc"
                                type="video/mp4"
                            >
                        </video>

                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue'

const videoSection = ref(null)
const videoElement = ref(null)
const shouldLoadVideo = ref(false)

const videoSrc = '/images/destinations/paris/seagull-in-paris-2026-01-28-04-58-45-utc.mp4'
const posterSrc = '/images/destinations/paris/video-poster.webp'

let observer = null

const loadVideo = async () => {
    if (shouldLoadVideo.value) {
        return
    }

    shouldLoadVideo.value = true

    await nextTick()

    if (videoElement.value) {
        videoElement.value.play().catch(() => {
            console.log('Autoplay was prevented by the browser.')
        })
    }
}

onMounted(() => {
    if (!('IntersectionObserver' in window)) {
        loadVideo()
        return
    }

    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                loadVideo()

                if (observer && videoSection.value) {
                    observer.unobserve(videoSection.value)
                }
            }
        })
    }, {
        rootMargin: '400px'
    })

    if (videoSection.value) {
        observer.observe(videoSection.value)
    }
})

onUnmounted(() => {
    if (observer) {
        observer.disconnect()
    }
})
</script>
<style scoped>
.video-wrapper {
    position: relative;
    overflow: hidden;
}

.video-placeholder {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background: #020617;
}

.video-poster {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.video-placeholder-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(2, 6, 23, 0.35);
    color: white;
}

.video-loader {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 22px;
    border-radius: 999px;
    background: rgba(15, 23, 42, 0.75);
    backdrop-filter: blur(10px);
    font-weight: 600;
}

.video-spinner {
    width: 22px;
    height: 22px;
    border: 3px solid rgba(255, 255, 255, 0.25);
    border-top-color: rgba(255, 255, 255, 0.95);
    border-radius: 50%;
    animation: video-spin 0.8s linear infinite;
}

@keyframes video-spin {
    to {
        transform: rotate(360deg);
    }
}
</style>