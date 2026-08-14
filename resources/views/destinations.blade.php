<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations | TravelLux</title>

    @vite(['resources/scss/pages/destinations.scss', 'resources/js/pages/destinations.js'])
</head>

<body>
<div id="app">

    <main-navbar></main-navbar>

    <section class="destinations-hero">
        <picture class="destinations-hero-media" aria-hidden="true">
            <source type="image/webp" srcset="
                    {{ asset('images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc-480.webp') }} 480w,
                    {{ asset('images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc-960.webp') }} 960w,
                    {{ asset('images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc-1600.webp') }} 1600w
                " sizes="100vw">

            <img src="{{ asset('images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc-1600.webp') }}" alt="" class="destinations-hero-image" decoding="async">
        </picture>

        <div class="destinations-hero-overlay"></div>

        <div class="container destinations-hero-content">
            <h1>Find your next journey</h1>

            <p>
                Explore curated destinations, luxury escapes and unforgettable travel packages.
            </p>
        </div>
    </section>

    <destination-listing 
        :initial-paginator='@json($destinations)' 
        :types='@json($types)' 
        :initial-filters='@json($filters)' 
        ajax-endpoint="{{ route('ajax.destinations') }}"></destination-listing>

    @include('parts.footer')

</div>
</body>
</html>