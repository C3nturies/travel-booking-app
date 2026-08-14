<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking | TravelLux</title>

    @vite(['resources/scss/pages/booking.scss', 'resources/js/pages/booking.js'])
</head>

<body>
<div id="app">

    <main-navbar></main-navbar>
    @php
        $fallbackHeroImage = 'images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc.webp';

        $heroImage =  $destination->hero_image;

        $heroBase = preg_replace('/\.(webp|jpg|jpeg|png)$/i', '', $heroImage);

        $heroTitle = $destination
            ? 'Book ' . $destination->title
            : 'Book your travel experience';

        $heroSubtitle = $destination
            ? $destination->short_description
            : 'Complete your reservation and personalize your journey.';

        $heroLabel = $destination
            ? $destination->country
            : 'Secure your trip';
    @endphp

    <section class="booking-hero">
        <picture class="booking-hero-media" aria-hidden="true">
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
                class="booking-hero-image"
                decoding="async"
            >
        </picture>

        <div class="booking-hero-overlay"></div>

        <div class="container booking-hero-content">
            <span>{{ $heroLabel }}</span>

            <h1>{{ $heroTitle }}</h1>

            <p>{{ $heroSubtitle }}</p>
        </div>
    </section>
    <booking-form :initial-destinations='@json($destinations)' :slug='@json($selectedSlug)'></booking-form>


    @include('parts.footer')

</div>
</body>
</html>