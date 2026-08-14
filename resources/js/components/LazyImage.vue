<template>
    <div  ref="wrapper" class="lazy-image-wrapper">
        <div
            v-if="!isLoaded"
            class="lazy-image-placeholder"
        >
            <div class="lazy-spinner"></div>
        </div>

        <img
            v-if="shouldLoad"
            :src="src"
            :srcset="srcset"
            :sizes="sizes"
            :alt="alt"
            :class="['lazy-image', imageClass, { 'is-loaded': isLoaded }]"
            decoding="async"
            @load="handleLoad"
            @error="handleError"
        >
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    src: {
        type: String,
        required: true
    },
    srcset: {
        type: String,
        default: ''
    },
    sizes: {
        type: String,
        default: ''
    },
    alt: {
        type: String,
        default: ''
    },
    imageClass: {
        type: String,
        default: ''
    },
    rootMargin: {
        type: String,
        default: '300px'
    }
})

const wrapper = ref(null)
const shouldLoad = ref(false)
const isLoaded = ref(false)

let observer = null

const handleLoad = () => {
    isLoaded.value = true
}

const handleError = () => {
    isLoaded.value = true
}

onMounted(() => {
    if (!('IntersectionObserver' in window)) {
        shouldLoad.value = true
        return
    }

    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                shouldLoad.value = true

                if (observer && wrapper.value) {
                    observer.unobserve(wrapper.value)
                }
            }
        })
    }, {
        rootMargin: props.rootMargin
    })

    if (wrapper.value) {
        observer.observe(wrapper.value)
    }
})

onUnmounted(() => {
    if (observer) {
        observer.disconnect()
    }
})
</script>

<style scoped>
.lazy-image-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: #e5e7eb;
}

.lazy-image-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
        linear-gradient(
            90deg,
            #e5e7eb 0%,
            #f3f4f6 50%,
            #e5e7eb 100%
        );
    background-size: 200% 100%;
    animation: skeleton-loading 1.4s infinite;
    z-index: 1;
}

.lazy-spinner {
    width: 34px;
    height: 34px;
    border: 3px solid rgba(15, 23, 42, 0.15);
    border-top-color: rgba(15, 23, 42, 0.55);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

.lazy-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    opacity: 0;
    transform: scale(1.03);
    transition:
        opacity 0.45s ease,
        transform 0.45s ease;
}

.lazy-image.is-loaded {
    opacity: 1;
    transform: scale(1);
}

@keyframes skeleton-loading {
    from {
        background-position: 200% 0;
    }

    to {
        background-position: -200% 0;
    }
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>