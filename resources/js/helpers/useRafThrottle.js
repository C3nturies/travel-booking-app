export const useRafThrottle = (callback) => {
    let isTicking = false

    return (...args) => {
        if (isTicking) {
            return
        }

        isTicking = true

        requestAnimationFrame(() => {
            callback(...args)
            isTicking = false
        })
    }
}