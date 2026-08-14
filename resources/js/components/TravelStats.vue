<template>
    <section class="stats-section">
        <div class="container">
            <div class="row text-center g-4">
                <div
                    v-for="stat in stats"
                    :key="stat.label"
                    class="col-md-3"
                >
                    <div class="stat-card">
                        <h2>{{ stat.value }}</h2>
                        <p>{{ stat.label }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const stats = [
    { value: '20K+', label: 'Happy Travelers' },
    { value: '120+', label: 'Luxury Destinations' },
    { value: '15', label: 'Years Experience' },
    { value: '4.9', label: 'Average Rating' },
]
</script>