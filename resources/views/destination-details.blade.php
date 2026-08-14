<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $destination->title }} | TravelLux</title>

    @vite(['resources/scss/pages/destination-details.scss', 'resources/js/pages/destination-details.js'])
</head>

<body>
<div id="app">

    <main-navbar></main-navbar>

    @php
        $heroImage = $destination->hero_image;
        $heroBase = preg_replace('/\.(webp|jpg|jpeg|png)$/i', '', $heroImage);
    @endphp

    <section class="details-hero">
        <picture class="details-hero-media" aria-hidden="true">
            <source
                type="image/webp"
                srcset="
                    {{ asset(ltrim($heroBase . '-480.webp', '/')) }} 480w,
                    {{ asset(ltrim($heroBase . '-960.webp', '/')) }} 960w,
                    {{ asset(ltrim($heroBase . '-1600.webp', '/')) }} 1600w
                "
                sizes="100vw"
            >

            <img
                src="{{ asset(ltrim($heroBase . '-1600.webp', '/')) }}"
                alt=""
                class="hero-image"
                decoding="async"
            >
        </picture>

        <div class="details-hero-overlay"></div>

        <div class="container details-hero-content">
            <span class="details-badge">{{ $destination->country }}</span>

            <h1>{{ $destination->title }}</h1>

            <p>{{ $destination->short_description }}</p>
        </div>
    </section>

    <destination-details :initial-destination='@json($destination)'></destination-details>

    @include('parts.footer')

</div>
</body>
</html>