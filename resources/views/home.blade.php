<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Luxury Travel</title>

    @vite(['resources/scss/pages/home.scss', 'resources/js/pages/home.js'])

</head>

<body>

    <!-- MAIN -->
    <div id="app">
        <!-- NAVBAR -->
        <main-navbar></main-navbar>
        <!-- HERO -->
        @php
        $heroImage = $firstHeroDestination->hero_image ?: $firstHeroDestination->optimized_hero_image;
        $heroBase = preg_replace('/\.(webp|jpg|jpeg|png)$/i', '', $heroImage);
        @endphp

        <section id="hero-slider-root">
            <hero-slider :slides='@json($heroDestinations)' :initial-slide='@json($firstHeroDestination)'>
                <section class="hero-section">
                    <div class="hero-slide">
                        <div class="hero-overlay"></div>

                        <img class="hero-image" src="{{ asset(ltrim($heroBase . '-1600.webp', '/')) }}" srcset="
                                {{ asset(ltrim($heroBase . '-480.webp', '/')) }} 480w,
                                {{ asset(ltrim($heroBase . '-960.webp', '/')) }} 960w,
                                {{ asset(ltrim($heroBase . '-1600.webp', '/')) }} 1600w
                            " sizes="100vw" alt="{{ $firstHeroDestination->title }}" decoding="async" loading="eager">

                        <div class="hero-content">
                            <h1>
                                {{ $firstHeroDestination->title }}
                            </h1>

                            <div class="hero-price-badge">
                                From €{{ number_format($firstHeroDestination->price, 0) }}
                            </div>

                            <p>
                                {{ $firstHeroDestination->short_description }}
                            </p>

                            <a href="/destinations/{{ $firstHeroDestination->slug }}" class="btn btn-warning btn-lg rounded-pill px-5">
                                Explore destination
                            </a>
                        </div>
                    </div>
                </section>
            </hero-slider>
        </section>



        {{--<hero-slider :slides='@json($heroDestinations)'></hero-slider>--}}
        <lazy-mount min-height="850px" root-margin="700px">
            <div class="cv-auto">
                <luxury-showcase></luxury-showcase>
            </div>
        </lazy-mount>
     
        <!-- CAROUSEL 1 -->
        <lazy-mount min-height="950px" root-margin="700px">
            <section class="py-5 bg-dark cv-auto-large">
                <div class="container">
                    <h2 class="section-title">
                        Popular Destinations
                    </h2>

                    <destination-carousel endpoint="{{ route('ajax.popular-destinations') }}"></destination-carousel>
                </div>
            </section>
        </lazy-mount>

        <!-- CAROUSEL 2 -->
        <lazy-mount min-height="900px" root-margin="700px">
            <section class="py-5 bg-light cv-auto-large">
                <div class="container">
                    <h2 class="section-title-dark">
                        Travel Packages
                    </h2>

                    <minimal-carousel :initial-destinations='@json($featuredDestinations)'></minimal-carousel>
                </div>
            </section>
        </lazy-mount>


        <lazy-mount min-height="800px" root-margin="700px">
            <section class="cv-auto">
                <travel-video-section></travel-video-section>
            </section>
        </lazy-mount>


        <!-- STATS -->
        <lazy-mount min-height="500px" root-margin="700px" class="stats-lazy-mount">
            <div class="cv-auto-small">
                <travel-stats></travel-stats>
            </div>
        </lazy-mount>

        <!-- CAROUSEL 3 -->
        <lazy-mount min-height="1000px" root-margin="700px">
            <section class="py-5 experience-section cv-auto-large">
                <div class="container">
                    <h2 class="section-title">
                        Premium Experiences
                    </h2>

                    <experience-carousel endpoint="{{ route('ajax.experience-destinations') }}"></experience-carousel>
                </div>
            </section>
        </lazy-mount>

        <!-- DEPTH SECTION -->
        <lazy-mount min-height="850px" root-margin="700px">
            <div class="cv-auto">
                <depth-travel-section></depth-travel-section>
            </div>
        </lazy-mount>

    </div>

    <!-- FOOTER -->
    <div class="cv-auto-small">
        @include('parts.footer')
    </div>

</body>
</html>