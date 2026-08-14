import Collapse from 'bootstrap/js/dist/collapse'

document.querySelectorAll('[data-bs-toggle="collapse"]').forEach((trigger) => {
    const targetSelector = trigger.getAttribute('data-bs-target')

    if (!targetSelector) {
        return
    }

    const target = document.querySelector(targetSelector)

    if (target) {
        new Collapse(target, {
            toggle: false
        })
    }
})