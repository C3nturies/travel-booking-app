<template>
    <section v-if="images.length" class="details-section destination-gallery-section">
        <div class="details-section-header">
            <span>Gallery</span>
            <h2>Moments from {{ destinationTitle }}</h2>
        </div>

        <div class="optimized-gallery-grid">
            <button
                v-for="image in images"
                :key="image.id"
                type="button"
                class="optimized-gallery-item"
                @click="openImage(image)"
            >
                <LazyImage
                    :src="getImageSrc(image, 960)"
                    :srcset="getImageSrcSet(image)"
                    sizes="(max-width: 576px) 92vw, (max-width: 992px) 45vw, 33vw"
                    :alt="getImageAlt(image)"
                    image-class="optimized-gallery-image"
                    root-margin="500px"
                />

                <span v-if="image.caption" class="gallery-caption">
                    {{ image.caption }}
                </span>
            </button>
        </div>

        <Teleport to="body">
            <div
                v-if="selectedImage"
                class="gallery-lightbox"
                @click.self="closeImage"
            >
                <button
                    type="button"
                    class="gallery-lightbox-close"
                    @click="closeImage"
                >
                    ×
                </button>

                <img
                    :src="getImageSrc(selectedImage, 1600)"
                    :srcset="getImageSrcSet(selectedImage)"
                    sizes="90vw"
                    :alt="getImageAlt(selectedImage)"
                    class="gallery-lightbox-image"
                    decoding="async"
                >

                <p v-if="selectedImage.caption" class="gallery-lightbox-caption">
                    {{ selectedImage.caption }}
                </p>
            </div>
        </Teleport>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import LazyImage from './LazyImage.vue'
import { getResponsiveSrc, getSrcSet } from '../helpers/imageHelpers'

const props = defineProps({
    images: {
        type: Array,
        default: () => []
    },

    destinationTitle: {
        type: String,
        default: ''
    }
})

const selectedImage = ref(null)

const normalizePath = (path) => {
    if (!path) {
        return ''
    }

    return path.startsWith('/') ? path : `/${path}`
}

const getImagePath = (image) => {
    return normalizePath(image.image_url || image.image_path || image.path || '')
}

const getImageSrc = (image, size) => {
    const path = getImagePath(image)

    if (!path) {
        return ''
    }

    return getResponsiveSrc(path, size)
}

const getImageSrcSet = (image) => {
    const path = getImagePath(image)

    if (!path) {
        return ''
    }

    return getSrcSet(path)
}

const getImageAlt = (image) => {
    return image.alt_text || image.caption || props.destinationTitle || 'Destination image'
}

const openImage = (image) => {
    selectedImage.value = image
    document.body.style.overflow = 'hidden'
}

const closeImage = () => {
    selectedImage.value = null
    document.body.style.overflow = ''
}

const handleKeydown = (event) => {
    if (event.key === 'Escape') {
        closeImage()
    }
}

onMounted(() => {
    window.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
    window.removeEventListener('keydown', handleKeydown)
    document.body.style.overflow = ''
})
</script>

<style scoped>
.destination-gallery-section {
    margin-top: 4rem;
}

.optimized-gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 1.25rem;
}

.optimized-gallery-item {
    position: relative;
    min-height: 260px;
    border: 0;
    padding: 0;
    border-radius: 24px;
    overflow: hidden;
    background: #111827;
    cursor: pointer;
}

.optimized-gallery-item :deep(.lazy-image-wrapper) {
    width: 100%;
    height: 100%;
    min-height: 260px;
}

.optimized-gallery-item :deep(.optimized-gallery-image) {
    width: 100%;
    height: 100%;
    min-height: 260px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.optimized-gallery-item:hover :deep(.optimized-gallery-image) {
    transform: scale(1.06);
}

.gallery-caption {
    position: absolute;
    left: 1rem;
    right: 1rem;
    bottom: 1rem;
    z-index: 2;
    padding: 0.75rem 1rem;
    border-radius: 999px;
    background: rgba(15, 23, 42, 0.72);
    color: #fff;
    font-size: 0.9rem;
    text-align: left;
    backdrop-filter: blur(12px);
}

.gallery-lightbox {
    position: fixed;
    inset: 0;
    z-index: 9999;
    padding: 2rem;
    background: rgba(2, 6, 23, 0.92);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.gallery-lightbox-image {
    max-width: min(1100px, 92vw);
    max-height: 78vh;
    object-fit: contain;
    border-radius: 24px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
}

.gallery-lightbox-close {
    position: fixed;
    top: 1.5rem;
    right: 1.5rem;
    width: 44px;
    height: 44px;
    border: 0;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.14);
    color: #fff;
    font-size: 2rem;
    line-height: 1;
    cursor: pointer;
}

.gallery-lightbox-caption {
    margin-top: 1rem;
    color: #e5e7eb;
    font-size: 1rem;
}

@media (max-width: 992px) {
    .optimized-gallery-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 576px) {
    .optimized-gallery-grid {
        grid-template-columns: 1fr;
    }

    .optimized-gallery-item,
    .optimized-gallery-item :deep(.lazy-image-wrapper),
    .optimized-gallery-item :deep(.optimized-gallery-image) {
        min-height: 230px;
    }

    .gallery-lightbox {
        padding: 1rem;
    }
}
</style>