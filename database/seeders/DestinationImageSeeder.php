<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationImageSeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            'santorini-luxury-stay-243' => [
                'expected_id' => 1,
                'images' => [
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-24-10-14-04-utc.jpg',
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-19-22-49-35-utc.jpg',
                    'images/destinations/santorini/view-on-oia-in-santorini-2026-03-19-03-21-44-utc.jpg',
                    'images/destinations/santorini/white-churches-an-blue-domes-by-the-ocean-of-oia-s-2026-03-16-04-28-16-utc.jpg',
                    'images/destinations/santorini/gallery/santorini-blue-dome-church-look-through-the-chimne-2026-03-26-08-18-29-utc.jpg',
                    'images/destinations/santorini/gallery/view-on-oia-in-santorini-2026-03-18-08-25-37-utc.jpg',
                ],
            ],
            'dubai-premium-experience-525' => [
                'expected_id' => 2,
                'images' => [
                    'images/destinations/dubai/51667-burj-al-arab-hotel-and-madinat-jumeirah-reso-2026-03-25-00-59-40-utc.jpg',
                    'images/destinations/dubai/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-03-10-04-49-51-utc.jpg',
                    'images/destinations/dubai/tall-buildings-of-marina-bay-in-dubai-the-uae-dur-2026-03-18-05-43-45-utc.jpg',
                    'images/destinations/dubai/skyscrapers-skyline-of-dubai-uae-downtown-with-bur-2026-03-11-04-23-31-utc.jpg',
                    'images/destinations/dubai/gallery/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-01-05-06-34-51-utc.jpg',
                    'images/destinations/dubai/gallery/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-03-10-02-03-26-utc.jpg',
                ],
            ],
            'thailand-island-hopping-19' => [
                'expected_id' => 3,
                'images' => [
                    'images/destinations/thailand/ayutthaya-thailand-at-wat-chaiwatthanaram-2026-03-24-11-25-14-utc.jpg',
                    'images/destinations/thailand/demon-guardians-in-grand-palace-2026-03-09-03-25-16-utc.jpg',
                    'images/destinations/thailand/koh-loa-lading-krabi-thailand-part-of-the-koh-hong-2026-03-09-01-50-24-utc.jpg',
                    'images/destinations/thailand/sea-views-and-rocky-islands-with-a-long-tail-boat-2026-03-20-00-02-49-utc.jpg',
                    'images/destinations/thailand/aerial-drone-view-of-railay-beach-krabi-thailand-2026-03-17-00-03-28-utc.jpg',
                    'images/destinations/thailand/gallery/sanctuary-of-truth-pattaya-thailand-wooden-temp-2026-03-25-03-30-44-utc.jpg',
                ],
            ],
            'machu-picchu-trek-645' => [
                'expected_id' => 4,
                'images' => [
                    'images/destinations/machu_picchu/breathtaking-landscape-of-ancient-majestic-machupi-2026-03-20-00-59-09-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-in-peru-2026-03-26-06-42-48-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-peru-2026-01-09-09-28-13-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-the-inca-citadel-high-in-the-andes-2026-03-25-00-58-55-utc.jpg',
                    'images/destinations/machu_picchu/peru-andes-urubamba-valley-machu-picchu-with-mo-2026-03-09-04-33-27-utc.jpg',
                    'images/destinations/machu_picchu/inca-village-in-the-mountains-2026-03-26-00-43-46-utc.jpg',
                ],
            ],
            'norway-fjord-explorer-264' => [
                'expected_id' => 5,
                'images' => [
                    'images/destinations/norway/the-fishing-village-of-reine-lofoten-norway-2026-01-09-11-34-48-utc.jpg',
                    'images/destinations/norway/gallery/beautiful-nature-norway-aerial-photography-2026-03-24-07-08-21-utc.jpg',
                    'images/destinations/norway/gallery/bridge-and-northern-lights-over-snowy-mountains-l-2026-03-17-03-36-15-utc.jpg',
                    'images/destinations/norway/gallery/geiranger-fjord-norway-aerial-photography-2026-03-19-10-31-55-utc.jpg',
                    'images/destinations/norway/gallery/view-on-bruges-2026-03-25-00-23-18-utc.jpg',
                    'images/destinations/norway/gallery/yachts-moored-in-harbour-of-bergan-norway-2026-03-19-23-26-54-utc.jpg',
                ],
            ],
            'croatian-island-cruise-630' => [
                'expected_id' => 6,
                'images' => [
                    'images/destinations/croatia/stunning-aerial-view-of-rovinj-croatia-at-sunset-2026-01-07-05-59-41-utc.jpg',
                    'images/destinations/croatia/gallery/aerial-view-photo-of-picturesque-port-with-sailboa-2026-03-10-22-41-28-utc.jpg',
                    'images/destinations/croatia/gallery/breathtaking-cityscape-of-buildings-surrounded-by-2026-03-18-13-23-27-utc.jpg',
                    'images/destinations/croatia/gallery/dubrovnik-croatia-view-from-the-air-2026-03-24-09-00-39-utc.jpg',
                    'images/destinations/croatia/gallery/rovinj-croatia-on-the-istria-peninsula-2026-06-02-19-46-41-utc.jpg',
                    'images/destinations/croatia/gallery/rovinj-croatia-on-the-istria-peninsula-2026-07-09-17-24-08-utc.jpg',
                ],
            ],
            'santorini-luxury-stay-952' => [
                'expected_id' => 7,
                'images' => [
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-24-10-14-04-utc.jpg',
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-19-22-49-35-utc.jpg',
                    'images/destinations/santorini/view-on-oia-in-santorini-2026-03-19-03-21-44-utc.jpg',
                    'images/destinations/santorini/white-churches-an-blue-domes-by-the-ocean-of-oia-s-2026-03-16-04-28-16-utc.jpg',
                    'images/destinations/santorini/gallery/santorini-blue-dome-church-look-through-the-chimne-2026-03-26-08-18-29-utc.jpg',
                    'images/destinations/santorini/gallery/view-on-oia-in-santorini-2026-03-18-08-25-37-utc.jpg',
                ],
            ],
            'machu-picchu-trek-408' => [
                'expected_id' => 8,
                'images' => [
                    'images/destinations/machu_picchu/breathtaking-landscape-of-ancient-majestic-machupi-2026-03-20-00-59-09-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-in-peru-2026-03-26-06-42-48-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-peru-2026-01-09-09-28-13-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-the-inca-citadel-high-in-the-andes-2026-03-25-00-58-55-utc.jpg',
                    'images/destinations/machu_picchu/peru-andes-urubamba-valley-machu-picchu-with-mo-2026-03-09-04-33-27-utc.jpg',
                    'images/destinations/machu_picchu/inca-village-in-the-mountains-2026-03-26-00-43-46-utc.jpg',
                ],
            ],
            'prague-discovery-130' => [
                'expected_id' => 9,
                'images' => [
                    'images/destinations/czech/the-view-over-prague-rooftops-2026-03-09-23-11-49-utc.jpg',
                    'images/destinations/czech/prague-astronomical-clock-2026-03-10-00-51-25-utc.jpg',
                    'images/destinations/czech/gallery/autumn-colorful-prague-lesser-town-with-gothic-cas-2026-03-25-22-49-04-utc.jpg',
                    'images/destinations/czech/gallery/peaceful-view-of-buildings-along-winding-river-2026-03-09-23-51-08-utc.jpg',
                    'images/destinations/czech/gallery/view-of-prague-at-night-2026-03-19-22-06-17-utc.jpg',
                    'images/destinations/czech/gallery/view-over-the-old-town-of-prague-at-night-2026-03-20-00-40-55-utc.jpg',
                ],
            ],
            'cape-town-explorer-729' => [
                'expected_id' => 10,
                'images' => [
                    'images/destinations/south_africa/aerial-view-of-a-waterfront-cape-town-cityscape-wi-2026-03-18-06-36-25-utc.jpg',
                    'images/destinations/south_africa/aerial-view-of-cape-town-south-africa-2026-03-09-04-08-23-utc.jpg',
                    'images/destinations/south_africa/aerial-view-of-the-city-of-cape-town-and-lion-s-he-2026-03-18-16-20-28-utc.jpg',
                    'images/destinations/south_africa/coastal-cityscape-at-sunset-under-soft-clouds-2026-03-10-00-03-28-utc.jpg',
                    'images/destinations/south_africa/iconic-table-mountain-and-the-breathtaking-city-of-2026-01-07-06-23-33-utc.jpg',
                    'images/destinations/south_africa/gallery/close-up-detail-of-skyscrapers-the-business-distri-2026-03-09-03-24-26-utc.jpg',
                ],
            ],
            'new-york-city-lights-621' => [
                'expected_id' => 11,
                'images' => [
                    'images/destinations/new_york/new-york-views-2026-03-17-00-26-23-utc.jpeg',
                    'images/destinations/new_york/statue-of-liberty-in-new-york-city-2026-03-24-08-44-29-utc.jpg',
                    'images/destinations/new_york/gallery/autumn-vibes-in-new-york-2026-01-06-09-39-00-utc.jpg',
                    'images/destinations/new_york/gallery/brooklyn-bridge-and-new-york-skyline-new-york-cit-2026-03-25-02-14-54-utc.jpg',
                    'images/destinations/new_york/gallery/sunset-stroll-across-the-city-bridge-2026-03-25-02-15-41-utc.jpg',
                    'images/destinations/new_york/gallery/sunset-view-over-a-city-skyline-from-a-bridge-2026-03-25-03-18-02-utc.jpg',
                ],
            ],
            'cape-town-explorer-668' => [
                'expected_id' => 12,
                'images' => [
                    'images/destinations/south_africa/aerial-view-of-a-waterfront-cape-town-cityscape-wi-2026-03-18-06-36-25-utc.jpg',
                    'images/destinations/south_africa/aerial-view-of-cape-town-south-africa-2026-03-09-04-08-23-utc.jpg',
                    'images/destinations/south_africa/aerial-view-of-the-city-of-cape-town-and-lion-s-he-2026-03-18-16-20-28-utc.jpg',
                    'images/destinations/south_africa/coastal-cityscape-at-sunset-under-soft-clouds-2026-03-10-00-03-28-utc.jpg',
                    'images/destinations/south_africa/iconic-table-mountain-and-the-breathtaking-city-of-2026-01-07-06-23-33-utc.jpg',
                    'images/destinations/south_africa/gallery/close-up-detail-of-skyscrapers-the-business-distri-2026-03-09-03-24-26-utc.jpg',
                ],
            ],
            'iceland-northern-lights-314' => [
                'expected_id' => 13,
                'images' => [
                    'images/destinations/iceland/aurora-nothern-lights-in-lofoten-islands-norway-2026-03-16-00-37-00-utc.jpg',
                    'images/destinations/iceland/northern-lights-over-kirkjufell-mountain-2026-03-19-02-13-50-utc.jpg',
                    'images/destinations/iceland/gallery/amazing-sunny-day-and-gorgeous-reflection-of-vest-2026-03-25-08-24-24-utc.jpg',
                    'images/destinations/iceland/gallery/breathtaking-view-of-hvitserkur-unique-basalt-rock-2026-03-17-07-10-49-utc.jpg',
                    'images/destinations/iceland/gallery/bruarfoss-waterfall-reykjavik-iceland-2026-03-17-00-11-59-utc.jpg',
                    'images/destinations/iceland/gallery/impressive-sunny-day-and-lupine-flowers-on-stokks-2026-03-25-08-28-02-utc.jpg',
                ],
            ],
            'thailand-island-hopping-642' => [
                'expected_id' => 14,
                'images' => [
                    'images/destinations/thailand/ayutthaya-thailand-at-wat-chaiwatthanaram-2026-03-24-11-25-14-utc.jpg',
                    'images/destinations/thailand/demon-guardians-in-grand-palace-2026-03-09-03-25-16-utc.jpg',
                    'images/destinations/thailand/koh-loa-lading-krabi-thailand-part-of-the-koh-hong-2026-03-09-01-50-24-utc.jpg',
                    'images/destinations/thailand/sea-views-and-rocky-islands-with-a-long-tail-boat-2026-03-20-00-02-49-utc.jpg',
                    'images/destinations/thailand/aerial-drone-view-of-railay-beach-krabi-thailand-2026-03-17-00-03-28-utc.jpg',
                    'images/destinations/thailand/gallery/sanctuary-of-truth-pattaya-thailand-wooden-temp-2026-03-25-03-30-44-utc.jpg',
                ],
            ],
            'maldives-ocean-retreat-454' => [
                'expected_id' => 15,
                'images' => [
                    'images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc.jpg',
                    'images/destinations/maldives/over-under-view-of-tropical-island-and-house-2026-03-24-15-40-31-utc.jpg',
                    'images/destinations/maldives/gallery/palm-trees-and-beach-umbrelllas-over-lagoon-and-wh-2026-03-16-04-29-33-utc.jpg',
                    'images/destinations/maldives/gallery/paradise-tropical-beach-with-coconut-palm-trees-on-2026-07-24-18-07-20-utc.jpg',
                    'images/destinations/maldives/gallery/perfect-white-beach-with-turquoise-water-at-ideal-2026-03-18-17-41-32-utc.jpg',
                    'images/destinations/maldives/gallery/water-villas-in-a-row-by-the-seashore-on-maldives-2026-03-25-02-15-02-utc.jpg',
                ],
            ],
            'machu-picchu-trek-744' => [
                'expected_id' => 16,
                'images' => [
                    'images/destinations/machu_picchu/breathtaking-landscape-of-ancient-majestic-machupi-2026-03-20-00-59-09-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-in-peru-2026-03-26-06-42-48-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-peru-2026-01-09-09-28-13-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-the-inca-citadel-high-in-the-andes-2026-03-25-00-58-55-utc.jpg',
                    'images/destinations/machu_picchu/peru-andes-urubamba-valley-machu-picchu-with-mo-2026-03-09-04-33-27-utc.jpg',
                    'images/destinations/machu_picchu/inca-village-in-the-mountains-2026-03-26-00-43-46-utc.jpg',
                ],
            ],
            'swiss-alps-adventure-376' => [
                'expected_id' => 17,
                'images' => [
                    'images/destinations/switzerland/aerial-view-of-lake-of-the-four-cantons-morschach-2026-03-13-01-59-07-utc.jpg',
                    'images/destinations/switzerland/bachalpsee-lake-in-swiss-alps-mountains-2026-03-19-08-12-57-utc.jpg',
                    'images/destinations/switzerland/engelberg-switzerlan-with-eugenisee-lake-and-alps-2026-01-09-06-31-04-utc.jpg',
                    'images/destinations/switzerland/gallery/amazing-autumn-view-of-bern-city-on-aare-river-wit-2026-03-17-00-05-03-utc.jpg',
                    'images/destinations/switzerland/gallery/foggy-autumnal-sunrise-at-famous-hallstatt-lakesid-2026-03-17-07-14-37-utc.jpg',
                    'images/destinations/switzerland/gallery/scenic-mountains-with-flag-above-sea-of-clouds-2026-03-26-02-59-02-utc.jpg',
                ],
            ],
            'bali-paradise-escape-146' => [
                'expected_id' => 18,
                'images' => [
                    'images/destinations/bali/tropical-poolside-resort-with-palms-and-loungers-2026-03-16-00-38-20-utc.jpg',
                    'images/destinations/bali/woman-with-backpack-exploring-bali-indonesia-2026-03-18-13-42-37-utc.jpg',
                    'images/destinations/bali/gallery/couple-row-boating-by-hindu-temple-on-lake-2026-01-09-00-01-38-utc.jpg',
                    'images/destinations/bali/gallery/famous-bali-landmark-jatiluwih-rice-terraces-beau-2026-03-09-05-19-59-utc.jpg',
                    'images/destinations/bali/gallery/famous-bratan-temple-on-the-lake-bali-indonesia-2026-03-09-21-49-03-utc.jpg',
                    'images/destinations/bali/gallery/ulun-danu-temple-2026-03-16-05-06-26-utc.jpg',
                ],
            ],
            'machu-picchu-trek-124' => [
                'expected_id' => 19,
                'images' => [
                    'images/destinations/machu_picchu/breathtaking-landscape-of-ancient-majestic-machupi-2026-03-20-00-59-09-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-in-peru-2026-03-26-06-42-48-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-peru-2026-01-09-09-28-13-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-the-inca-citadel-high-in-the-andes-2026-03-25-00-58-55-utc.jpg',
                    'images/destinations/machu_picchu/peru-andes-urubamba-valley-machu-picchu-with-mo-2026-03-09-04-33-27-utc.jpg',
                    'images/destinations/machu_picchu/inca-village-in-the-mountains-2026-03-26-00-43-46-utc.jpg',
                ],
            ],
            'iceland-northern-lights-162' => [
                'expected_id' => 20,
                'images' => [
                    'images/destinations/iceland/aurora-nothern-lights-in-lofoten-islands-norway-2026-03-16-00-37-00-utc.jpg',
                    'images/destinations/iceland/northern-lights-over-kirkjufell-mountain-2026-03-19-02-13-50-utc.jpg',
                    'images/destinations/iceland/gallery/amazing-sunny-day-and-gorgeous-reflection-of-vest-2026-03-25-08-24-24-utc.jpg',
                    'images/destinations/iceland/gallery/breathtaking-view-of-hvitserkur-unique-basalt-rock-2026-03-17-07-10-49-utc.jpg',
                    'images/destinations/iceland/gallery/bruarfoss-waterfall-reykjavik-iceland-2026-03-17-00-11-59-utc.jpg',
                    'images/destinations/iceland/gallery/impressive-sunny-day-and-lupine-flowers-on-stokks-2026-03-25-08-28-02-utc.jpg',
                ],
            ],
            'dubai-premium-experience-128' => [
                'expected_id' => 21,
                'images' => [
                    'images/destinations/dubai/51667-burj-al-arab-hotel-and-madinat-jumeirah-reso-2026-03-25-00-59-40-utc.jpg',
                    'images/destinations/dubai/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-03-10-04-49-51-utc.jpg',
                    'images/destinations/dubai/tall-buildings-of-marina-bay-in-dubai-the-uae-dur-2026-03-18-05-43-45-utc.jpg',
                    'images/destinations/dubai/skyscrapers-skyline-of-dubai-uae-downtown-with-bur-2026-03-11-04-23-31-utc.jpg',
                    'images/destinations/dubai/gallery/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-01-05-06-34-51-utc.jpg',
                    'images/destinations/dubai/gallery/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-03-10-02-03-26-utc.jpg',
                ],
            ],
            'swiss-alps-adventure-658' => [
                'expected_id' => 22,
                'images' => [
                    'images/destinations/switzerland/aerial-view-of-lake-of-the-four-cantons-morschach-2026-03-13-01-59-07-utc.jpg',
                    'images/destinations/switzerland/bachalpsee-lake-in-swiss-alps-mountains-2026-03-19-08-12-57-utc.jpg',
                    'images/destinations/switzerland/engelberg-switzerlan-with-eugenisee-lake-and-alps-2026-01-09-06-31-04-utc.jpg',
                    'images/destinations/switzerland/gallery/amazing-autumn-view-of-bern-city-on-aare-river-wit-2026-03-17-00-05-03-utc.jpg',
                    'images/destinations/switzerland/gallery/foggy-autumnal-sunrise-at-famous-hallstatt-lakesid-2026-03-17-07-14-37-utc.jpg',
                    'images/destinations/switzerland/gallery/scenic-mountains-with-flag-above-sea-of-clouds-2026-03-26-02-59-02-utc.jpg',
                ],
            ],
            'bali-paradise-escape-492' => [
                'expected_id' => 23,
                'images' => [
                    'images/destinations/bali/tropical-poolside-resort-with-palms-and-loungers-2026-03-16-00-38-20-utc.jpg',
                    'images/destinations/bali/woman-with-backpack-exploring-bali-indonesia-2026-03-18-13-42-37-utc.jpg',
                    'images/destinations/bali/gallery/couple-row-boating-by-hindu-temple-on-lake-2026-01-09-00-01-38-utc.jpg',
                    'images/destinations/bali/gallery/famous-bali-landmark-jatiluwih-rice-terraces-beau-2026-03-09-05-19-59-utc.jpg',
                    'images/destinations/bali/gallery/famous-bratan-temple-on-the-lake-bali-indonesia-2026-03-09-21-49-03-utc.jpg',
                    'images/destinations/bali/gallery/ulun-danu-temple-2026-03-16-05-06-26-utc.jpg',
                ],
            ],
            'paris-romantic-weekend-744' => [
                'expected_id' => 24,
                'images' => [
                    'images/destinations/paris/seine-in-paris-with-eiffel-tower-in-autumn-time-2026-04-13-23-13-15-utc.jpg',
                    'images/destinations/paris/gallery/aerial-view-of-arc-de-triomphe-paris-2026-01-05-04-40-52-utc.jpg',
                    'images/destinations/paris/gallery/alexander-bridge-paris-view-on-the-famous-landmar-2026-03-17-20-12-23-utc.jpg',
                    'images/destinations/paris/gallery/bridge-of-the-alexandre-iii-paris-2026-03-19-03-21-14-utc.jpg',
                    'images/destinations/paris/gallery/seine-in-paris-in-the-evening-2026-03-19-10-40-30-utc.jpg',
                    'images/destinations/paris/gallery/the-eiffel-tower-2026-03-24-09-10-18-utc.jpg',
                ],
            ],
            'swiss-alps-adventure-862' => [
                'expected_id' => 25,
                'images' => [
                    'images/destinations/switzerland/aerial-view-of-lake-of-the-four-cantons-morschach-2026-03-13-01-59-07-utc.jpg',
                    'images/destinations/switzerland/bachalpsee-lake-in-swiss-alps-mountains-2026-03-19-08-12-57-utc.jpg',
                    'images/destinations/switzerland/engelberg-switzerlan-with-eugenisee-lake-and-alps-2026-01-09-06-31-04-utc.jpg',
                    'images/destinations/switzerland/gallery/amazing-autumn-view-of-bern-city-on-aare-river-wit-2026-03-17-00-05-03-utc.jpg',
                    'images/destinations/switzerland/gallery/foggy-autumnal-sunrise-at-famous-hallstatt-lakesid-2026-03-17-07-14-37-utc.jpg',
                    'images/destinations/switzerland/gallery/scenic-mountains-with-flag-above-sea-of-clouds-2026-03-26-02-59-02-utc.jpg',
                ],
            ],
            'santorini-luxury-stay-644' => [
                'expected_id' => 26,
                'images' => [
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-24-10-14-04-utc.jpg',
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-19-22-49-35-utc.jpg',
                    'images/destinations/santorini/view-on-oia-in-santorini-2026-03-19-03-21-44-utc.jpg',
                    'images/destinations/santorini/white-churches-an-blue-domes-by-the-ocean-of-oia-s-2026-03-16-04-28-16-utc.jpg',
                    'images/destinations/santorini/gallery/santorini-blue-dome-church-look-through-the-chimne-2026-03-26-08-18-29-utc.jpg',
                    'images/destinations/santorini/gallery/view-on-oia-in-santorini-2026-03-18-08-25-37-utc.jpg',
                ],
            ],
            'machu-picchu-trek-462' => [
                'expected_id' => 27,
                'images' => [
                    'images/destinations/machu_picchu/breathtaking-landscape-of-ancient-majestic-machupi-2026-03-20-00-59-09-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-in-peru-2026-03-26-06-42-48-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-peru-2026-01-09-09-28-13-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-the-inca-citadel-high-in-the-andes-2026-03-25-00-58-55-utc.jpg',
                    'images/destinations/machu_picchu/peru-andes-urubamba-valley-machu-picchu-with-mo-2026-03-09-04-33-27-utc.jpg',
                    'images/destinations/machu_picchu/inca-village-in-the-mountains-2026-03-26-00-43-46-utc.jpg',
                ],
            ],
            'prague-discovery-240' => [
                'expected_id' => 28,
                'images' => [
                    'images/destinations/czech/the-view-over-prague-rooftops-2026-03-09-23-11-49-utc.jpg',
                    'images/destinations/czech/prague-astronomical-clock-2026-03-10-00-51-25-utc.jpg',
                    'images/destinations/czech/gallery/autumn-colorful-prague-lesser-town-with-gothic-cas-2026-03-25-22-49-04-utc.jpg',
                    'images/destinations/czech/gallery/peaceful-view-of-buildings-along-winding-river-2026-03-09-23-51-08-utc.jpg',
                    'images/destinations/czech/gallery/view-of-prague-at-night-2026-03-19-22-06-17-utc.jpg',
                    'images/destinations/czech/gallery/view-over-the-old-town-of-prague-at-night-2026-03-20-00-40-55-utc.jpg',
                ],
            ],
            'australian-coastal-escape-722' => [
                'expected_id' => 29,
                'images' => [
                    'images/destinations/australia/sydney-opera-house-at-sunset-2026-03-18-10-58-02-utc.jpg',
                    'images/destinations/australia/gallery/beautiful-shot-of-the-mary-booth-lookout-reserve-w-2026-03-18-06-38-47-utc.jpg',
                    'images/destinations/australia/gallery/beautiful-shot-of-the-sydney-harbor-bridge-with-a-2026-03-18-05-41-59-utc.jpeg',
                    'images/destinations/australia/gallery/panoramic-day-and-night-areal-image-of-brisbane-cb-2026-03-13-05-57-26-utc.jpg',
                    'images/destinations/australia/gallery/scenic-view-of-uluru-a-large-sandstone-formation-2026-03-18-09-29-26-utc.jpeg',
                    'images/destinations/australia/gallery/twelve-apostles-great-ocean-road-australia-2026-03-13-04-10-37-utc.jpg',
                ],
            ],
            'thailand-island-hopping-399' => [
                'expected_id' => 30,
                'images' => [
                    'images/destinations/thailand/ayutthaya-thailand-at-wat-chaiwatthanaram-2026-03-24-11-25-14-utc.jpg',
                    'images/destinations/thailand/demon-guardians-in-grand-palace-2026-03-09-03-25-16-utc.jpg',
                    'images/destinations/thailand/koh-loa-lading-krabi-thailand-part-of-the-koh-hong-2026-03-09-01-50-24-utc.jpg',
                    'images/destinations/thailand/sea-views-and-rocky-islands-with-a-long-tail-boat-2026-03-20-00-02-49-utc.jpg',
                    'images/destinations/thailand/aerial-drone-view-of-railay-beach-krabi-thailand-2026-03-17-00-03-28-utc.jpg',
                    'images/destinations/thailand/gallery/sanctuary-of-truth-pattaya-thailand-wooden-temp-2026-03-25-03-30-44-utc.jpg',
                ],
            ],
            'new-york-city-lights-62' => [
                'expected_id' => 31,
                'images' => [
                    'images/destinations/new_york/new-york-views-2026-03-17-00-26-23-utc.jpg',
                    'images/destinations/new_york/statue-of-liberty-in-new-york-city-2026-03-24-08-44-29-utc.jpg',
                    'images/destinations/new_york/gallery/autumn-vibes-in-new-york-2026-01-06-09-39-00-utc.jpg',
                    'images/destinations/new_york/gallery/brooklyn-bridge-and-new-york-skyline-new-york-cit-2026-03-25-02-14-54-utc.jpg',
                    'images/destinations/new_york/gallery/sunset-stroll-across-the-city-bridge-2026-03-25-02-15-41-utc.jpg',
                    'images/destinations/new_york/gallery/sunset-view-over-a-city-skyline-from-a-bridge-2026-03-25-03-18-02-utc.jpg',
                ],
            ],
            'machu-picchu-trek-474' => [
                'expected_id' => 32,
                'images' => [
                    'images/destinations/machu_picchu/breathtaking-landscape-of-ancient-majestic-machupi-2026-03-20-00-59-09-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-in-peru-2026-03-26-06-42-48-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-peru-2026-01-09-09-28-13-utc.jpg',
                    'images/destinations/machu_picchu/machu-picchu-the-inca-citadel-high-in-the-andes-2026-03-25-00-58-55-utc.jpg',
                    'images/destinations/machu_picchu/peru-andes-urubamba-valley-machu-picchu-with-mo-2026-03-09-04-33-27-utc.jpg',
                    'images/destinations/machu_picchu/inca-village-in-the-mountains-2026-03-26-00-43-46-utc.jpg',
                ],
            ],
            'canadian-rockies-486' => [
                'expected_id' => 33,
                'images' => [
                    'images/destinations/canada/mt-robson-2026-03-16-06-06-51-utc.jpg',
                    'images/destinations/canada/beautiful-moraine-lake-in-banff-national-park-can-2026-03-26-09-50-39-utc.jpg',
                    'images/destinations/canada/gallery/british-columbia-parliament-building-victoria-b-2026-06-03-19-34-51-utc.jpg',
                    'images/destinations/canada/gallery/scenic-mountain-view-with-canadian-flag-in-banff-2026-03-15-23-24-47-utc.jpg',
                    'images/destinations/canada/gallery/toronto-ontario-canada-cityscape-on-lake-ontario-2026-01-09-10-59-53-utc.jpg',
                    'images/destinations/canada/gallery/beautiful-peyto-lake-in-jasper-national-park-alber-2026-03-16-00-22-42-utc.jpg',
                ],
            ],
            'santorini-luxury-stay-37' => [
                'expected_id' => 34,
                'images' => [
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-24-10-14-04-utc.jpg',
                    'images/destinations/santorini/oia-village-santorini-greece-view-of-traditiona-2026-03-19-22-49-35-utc.jpg',
                    'images/destinations/santorini/view-on-oia-in-santorini-2026-03-19-03-21-44-utc.jpg',
                    'images/destinations/santorini/white-churches-an-blue-domes-by-the-ocean-of-oia-s-2026-03-16-04-28-16-utc.jpg',
                    'images/destinations/santorini/gallery/santorini-blue-dome-church-look-through-the-chimne-2026-03-26-08-18-29-utc.jpg',
                    'images/destinations/santorini/gallery/view-on-oia-in-santorini-2026-03-18-08-25-37-utc.jpg',
                ],
            ],
            'tokyo-urban-discovery-877' => [
                'expected_id' => 35,
                'images' => [
                    'images/destinations/japan/tokyo-tower-and-cityscape-at-night-with-beautiful-2026-03-19-23-37-59-utc.jpg',
                    'images/destinations/japan/gallery/beautiful-cherry-blossom-or-pink-sakura-flower-tre-2026-03-20-00-22-36-utc.jpg',
                    'images/destinations/japan/gallery/fujiyoshida-japan-at-chureito-pagoda-and-mt-fuji-2026-03-27-04-34-10-utc.jpg',
                    'images/destinations/japan/gallery/narai-juku-nagano-japan-historic-town-along-the-2026-03-24-11-25-14-utc.jpg',
                    'images/destinations/japan/gallery/osaka-november-25-the-famed-advertisements-of-d-2026-04-14-00-13-42-utc.jpg',
                    'images/destinations/japan/gallery/bamboo-forest-asian-woman-wearing-japanese-tradit-2026-03-26-05-38-20-utc.jpg',
                ],
            ],
            'dubai-premium-experience-49' => [
                'expected_id' => 36,
                'images' => [
                    'images/destinations/dubai/51667-burj-al-arab-hotel-and-madinat-jumeirah-reso-2026-03-25-00-59-40-utc.jpg',
                    'images/destinations/dubai/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-03-10-04-49-51-utc.jpg',
                    'images/destinations/dubai/tall-buildings-of-marina-bay-in-dubai-the-uae-dur-2026-03-18-05-43-45-utc.jpg',
                    'images/destinations/dubai/skyscrapers-skyline-of-dubai-uae-downtown-with-bur-2026-03-11-04-23-31-utc.jpg',
                    'images/destinations/dubai/gallery/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-01-05-06-34-51-utc.jpg',
                    'images/destinations/dubai/gallery/dubai-downtown-skyline-united-arab-emirates-or-ua-2026-03-10-02-03-26-utc.jpg',
                ],
            ],
            'thailand-island-hopping-671' => [
                'expected_id' => 37,
                'images' => [
                    'images/destinations/thailand/ayutthaya-thailand-at-wat-chaiwatthanaram-2026-03-24-11-25-14-utc.jpg',
                    'images/destinations/thailand/demon-guardians-in-grand-palace-2026-03-09-03-25-16-utc.jpg',
                    'images/destinations/thailand/koh-loa-lading-krabi-thailand-part-of-the-koh-hong-2026-03-09-01-50-24-utc.jpg',
                    'images/destinations/thailand/sea-views-and-rocky-islands-with-a-long-tail-boat-2026-03-20-00-02-49-utc.jpg',
                    'images/destinations/thailand/aerial-drone-view-of-railay-beach-krabi-thailand-2026-03-17-00-03-28-utc.jpg',
                    'images/destinations/thailand/gallery/sanctuary-of-truth-pattaya-thailand-wooden-temp-2026-03-25-03-30-44-utc.jpg',
                ],
            ],
            'maldives-ocean-retreat-9' => [
                'expected_id' => 38,
                'images' => [
                    'images/destinations/maldives/couple-in-white-on-a-tropical-beach-jetty-2026-03-09-08-13-45-utc.jpg',
                    'images/destinations/maldives/over-under-view-of-tropical-island-and-house-2026-03-24-15-40-31-utc.jpg',
                    'images/destinations/maldives/gallery/palm-trees-and-beach-umbrelllas-over-lagoon-and-wh-2026-03-16-04-29-33-utc.jpg',
                    'images/destinations/maldives/gallery/paradise-tropical-beach-with-coconut-palm-trees-on-2026-07-24-18-07-20-utc.jpg',
                    'images/destinations/maldives/gallery/perfect-white-beach-with-turquoise-water-at-ideal-2026-03-18-17-41-32-utc.jpg',
                    'images/destinations/maldives/gallery/water-villas-in-a-row-by-the-seashore-on-maldives-2026-03-25-02-15-02-utc.jpg',
                ],
            ],
            'thailand-island-hopping-7' => [
                'expected_id' => 39,
                'images' => [
                    'images/destinations/thailand/ayutthaya-thailand-at-wat-chaiwatthanaram-2026-03-24-11-25-14-utc.jpg',
                    'images/destinations/thailand/demon-guardians-in-grand-palace-2026-03-09-03-25-16-utc.jpg',
                    'images/destinations/thailand/koh-loa-lading-krabi-thailand-part-of-the-koh-hong-2026-03-09-01-50-24-utc.jpg',
                    'images/destinations/thailand/sea-views-and-rocky-islands-with-a-long-tail-boat-2026-03-20-00-02-49-utc.jpg',
                    'images/destinations/thailand/aerial-drone-view-of-railay-beach-krabi-thailand-2026-03-17-00-03-28-utc.jpg',
                    'images/destinations/thailand/gallery/sanctuary-of-truth-pattaya-thailand-wooden-temp-2026-03-25-03-30-44-utc.jpg',
                ],
            ],
            'canadian-rockies-889' => [
                'expected_id' => 40,
                'images' => [
                    'images/destinations/canada/mt-robson-2026-03-16-06-06-51-utc.jpg',
                    'images/destinations/canada/beautiful-moraine-lake-in-banff-national-park-can-2026-03-26-09-50-39-utc.jpg',
                    'images/destinations/canada/gallery/british-columbia-parliament-building-victoria-b-2026-06-03-19-34-51-utc.jpg',
                    'images/destinations/canada/gallery/scenic-mountain-view-with-canadian-flag-in-banff-2026-03-15-23-24-47-utc.jpg',
                    'images/destinations/canada/gallery/toronto-ontario-canada-cityscape-on-lake-ontario-2026-01-09-10-59-53-utc.jpg',
                    'images/destinations/canada/gallery/beautiful-peyto-lake-in-jasper-national-park-alber-2026-03-16-00-22-42-utc.jpg',
                ],
            ],
        ];

        foreach ($galleries as $slug => $gallery) {
            $destination = Destination::query()
                ->select(['id', 'title', 'slug'])
                ->where('slug', $slug)
                ->first();

            if (! $destination) {
                continue;
            }

            // Seeder treba dati točno šest galerijskih slika za svaku destinaciju.
            // Zato brišemo postojeće galerijske zapise za destinaciju i unosimo čisti set.
            DestinationImage::query()
                ->where('destination_id', $destination->id)
                ->delete();

            foreach (array_slice($gallery['images'], 0, 6) as $index => $path) {
                $cleanPath = $this->cleanImagePath($path);
                $caption = $this->captionFromPath($cleanPath);

                DestinationImage::query()->create([
                    'destination_id' => $destination->id,
                    'image_url' => $cleanPath,
                    'alt_text' => $caption . ' - ' . $destination->title,
                    'caption' => $caption,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }

    private function cleanImagePath(string $path): string
    {
        // Uklanja skrivene kontrolne znakove poput CR/LF/TAB iz kopiranog popisa,
        // ali ne mijenja normalne znakove u nazivu datoteke.
        $path = preg_replace('/[\x00-\x1F\x7F]+/u', '', $path) ?? $path;

        return ltrim(trim($path), '/');
    }

    private function captionFromPath(string $path): string
    {
        $name = pathinfo($path, PATHINFO_FILENAME);

        // Ukloni timestamp sufiks iz naziva slike, npr. -2026-03-18-10-58-02-utc.
        $name = preg_replace('/-\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}-utc$/', '', $name) ?? $name;

        $name = str_replace(['-', '_'], ' ', $name);

        return Str::title($name);
    }
}
