export const getImageBasePath = (imagePath) => {
    if (!imagePath) {
        return ''
    }

    return imagePath.replace(/\.(webp|jpg|jpeg|png)$/i, '')
}

export const getResponsiveSrc = (imagePath, size) => {
    const basePath = getImageBasePath(imagePath)

    return `${basePath}-${size}.webp`
}

export const getSrcSet = (imagePath) => {
    if (!imagePath) {
        return ''
    }

    return `
        ${getResponsiveSrc(imagePath, 480)} 480w,
        ${getResponsiveSrc(imagePath, 960)} 960w,
        ${getResponsiveSrc(imagePath, 1600)} 1600w
    `
}