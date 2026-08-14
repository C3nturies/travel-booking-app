<template>
    <div
        ref="mountTarget"
        class="lazy-mount"
        :style="wrapperStyle"
    >
        <template v-if="shouldRender">
            <slot></slot>
        </template>

        <div
            v-else
            class="lazy-mount-placeholder"
        >
            <div class="lazy-mount-skeleton"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    minHeight: {
        type: String,
        default: '700px'
    },
    rootMargin: {
        type: String,
        default: '600px'
    }
})

const mountTarget = ref(null)
const shouldRender = ref(false)

let observer = null

const wrapperStyle = computed(() => {
    return {
        minHeight: shouldRender.value ? null : props.minHeight
    }
})

const renderContent = () => {
    shouldRender.value = true

    if (observer && mountTarget.value) {
        observer.unobserve(mountTarget.value)
    }
}

onMounted(() => {
    if (!('IntersectionObserver' in window)) {
        renderContent()
        return
    }

    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                renderContent()
            }
        })
    }, {
        rootMargin: props.rootMargin
    })

    if (mountTarget.value) {
        observer.observe(mountTarget.value)
    }
})

onUnmounted(() => {
    if (observer) {
        observer.disconnect()
    }
})
</script>

<style scoped>
.lazy-mount {
    position: relative;
    width: 100%;
}

.lazy-mount-placeholder {
    width: 100%;
    height: 100%;
    min-height: inherit;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lazy-mount-skeleton {
    width: min(1100px, 92vw);
    height: 70%;
    min-height: 260px;
    border-radius: 32px;
    background: linear-gradient(
        90deg,
        #e5e7eb 0%,
        #f3f4f6 50%,
        #e5e7eb 100%
    );
    background-size: 200% 100%;
    animation: lazy-mount-loading 1.3s infinite;
}

@keyframes lazy-mount-loading {
    from {
        background-position: 200% 0;
    }

    to {
        background-position: -200% 0;
    }
}
</style>