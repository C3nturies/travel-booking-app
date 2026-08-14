# Travel Booking App

Ovaj projekt izrađen je u svrhu završnog rada na temu **„Optimizacija performansi kod web sučelja u web aplikacijama“**.

Aplikacija predstavlja web sustav za pregled turističkih destinacija i rezervaciju putovanja. Projekt je razvijen kao Laravel aplikacija s Blade predlošcima i Vue 3 komponentama, a glavni naglasak završnog rada je na optimizaciji performansi web sučelja kroz optimizaciju slika, CSS-a, JavaScripta, lazy loadinga, odgođenog renderiranja i backend upita.

---

## Korištene tehnologije

- Laravel
- Blade
- Vue 3
- Vite
- SCSS
- Bootstrap
- MySQL
- Laragon

---

## Glavne funkcionalnosti aplikacije

Aplikacija sadrži nekoliko glavnih stranica:

- početna stranica
- stranica s popisom destinacija
- stranica s detaljima destinacije
- stranica za rezervaciju putovanja

### Početna stranica

Početna stranica sadrži:

- hero slider
- luxury showcase sekciju
- popular destinations carousel
- travel packages carousel
- video sekciju
- travel stats sekciju
- premium experiences carousel
- depth travel sekciju

### Stranica s popisom destinacija

Stranica destinacija sadrži:

- hero sekciju
- filtere
- sortiranje
- grid destinacijskih kartica
- AJAX učitavanje dodatnih rezultata

### Stranica s detaljima destinacije

Stranica detalja destinacije sadrži:

- hero sekciju destinacije
- opis putovanja
- galeriju slika
- trip highlights sekciju
- itinerary sekciju
- recenzije putnika
- booking karticu

### Booking stranica

Booking stranica sadrži:

- dinamičku hero sekciju odabrane destinacije
- obrazac za rezervaciju
- odabir destinacije
- unos datuma i broja putnika
- dodatne opcije
- sažetak rezervacije

---

## Implementirane optimizacije

U projektu su provedene sljedeće optimizacije:

- pretvaranje slika u WebP format
- generiranje responzivnih slika u više veličina
- korištenje `srcset` i `sizes` atributa
- optimizacija hero slike kao LCP elementa
- Blade fallback za početni hero sadržaj
- lazy loading slika pomoću `LazyImage.vue`
- odgođeno renderiranje sekcija pomoću `LazyMount.vue`
- lazy loading video sadržaja
- page-specific JavaScript datoteke
- page-specific SCSS datoteke
- uklanjanje nepotrebnog globalnog CSS-a
- optimizacija Bootstrap importova
- lazy import Flatpickr biblioteke
- uklanjanje jQueryja iz booking forme
- korištenje nativnog `fetch` API-ja
- server-side filtriranje i sortiranje destinacija
- paginacija rezultata
- AJAX dohvaćanje carousel podataka
- keširanje često korištenih backend upita
- selektivno dohvaćanje stupaca iz baze pomoću `select()`
- optimizirana lokalna galerija destinacija

---

## Pokretanje projekta u Laragon okruženju

### 1. Preuzimanje projekta

Projekt je potrebno klonirati ili raspakirati u Laragon `www` direktorij.

Primjer putanje:

```txt
C:\laragon\www\travel-booking-app
```

Ako je projekt preuzet kao ZIP arhiva, potrebno ga je raspakirati tako da glavni folder projekta bude unutar:

```txt
C:\laragon\www
```

---

### 2. Pokretanje Laragona

Otvoriti Laragon i pokrenuti servise:

```txt
Start All
```

Potrebno je provjeriti da rade:

- Apache
- MySQL

---

### 3. Instalacija PHP dependencyja

U terminalu otvoriti folder projekta:

```bash
cd C:\laragon\www\travel-booking-app
```

Zatim pokrenuti:

```bash
composer install
```

---

### 4. Instalacija frontend dependencyja

Pokrenuti:

```bash
npm install
```

---

### 5. Postavljanje `.env` datoteke

Kopirati `.env.example` datoteku i preimenovati je u `.env`.

Ako se koristi Git Bash:

```bash
cp .env.example .env
```

Ako se radi ručno, potrebno je napraviti kopiju:

```txt
.env.example → .env
```

Primjer osnovnih postavki u `.env` datoteci:

```env
APP_NAME="Travel Booking App"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://travel-booking-app.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_booking_app
DB_USERNAME=root
DB_PASSWORD=
```

U Laragonu je korisničko ime za MySQL najčešće `root`, a lozinka je najčešće prazna.

---

### 6. Generiranje aplikacijskog ključa

Pokrenuti:

```bash
php artisan key:generate
```

---

### 7. Kreiranje baze podataka

U phpMyAdminu ili MySQL alatu potrebno je kreirati bazu:

```txt
travel_booking_app
```

U phpMyAdminu:

1. otvoriti phpMyAdmin
2. kliknuti **New**
3. upisati naziv baze `travel_booking_app`
4. kliknuti **Create**

---

### 8. Import baze podataka

Nakon kreiranja baze potrebno je importati SQL datoteku koja dolazi uz projekt.

Primjer naziva SQL datoteke:

```txt
travel_booking_app.sql
```

U phpMyAdminu:

1. odabrati bazu `travel_booking_app`
2. otvoriti karticu **Import**
3. odabrati SQL datoteku
4. kliknuti **Import**

---

### 9. Pokretanje produkcijskog builda

Za generiranje optimiziranih frontend datoteka pokrenuti:

```bash
npm run build
```

Ova naredba generira optimizirane CSS i JavaScript datoteke u `public/build` direktoriju.

---

### 10. Čišćenje i priprema Laravel cachea

Pokrenuti:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
```

Ako projekt nema closure rute, može se pokrenuti i:

```bash
php artisan route:cache
```

Ako se pojavi greška kod `route:cache`, ovu naredbu je dovoljno preskočiti.

---

### 11. Otvaranje aplikacije

Ako se projekt nalazi u folderu:

```txt
C:\laragon\www\travel-booking-app
```

Laragon će najčešće omogućiti adresu:

```txt
http://travel-booking-app.test
```

Ako se koristi port `8080`, aplikacija se može otvoriti putem:

```txt
http://travel-booking-app.test:8080
```

---

## Korisne naredbe

Čišćenje Laravel cachea:

```bash
php artisan optimize:clear
php artisan view:clear
php artisan config:clear
```

Ponovno generiranje frontend builda:

```bash
npm run build
```

Pokretanje development Vite servera:

```bash
npm run dev
```

Za finalno testiranje performansi preporučuje se koristiti:

```bash
npm run build
```

a ne `npm run dev`.

---

## Mogući problemi i rješenja

### Greška: Unable to locate file in Vite manifest

Ako se pojavi greška:

```txt
Unable to locate file in Vite manifest
```

potrebno je pokrenuti:

```bash
npm run build
php artisan optimize:clear
```

Također provjeriti postoji li datoteka:

```txt
public/hot
```

Ako postoji, može se obrisati jer označava korištenje Vite development servera.

---

### Slike se ne prikazuju

Provjeriti postoji li folder:

```txt
public/images
```

i jesu li slike pravilno raspakirane unutar projekta.

Također provjeriti jesu li putanje slika u bazi pravilno importane.

---

### Baza nije pronađena

Provjeriti `.env` datoteku:

```env
DB_DATABASE=travel_booking_app
DB_USERNAME=root
DB_PASSWORD=
```

Također provjeriti je li baza kreirana i je li SQL export pravilno importan.

---

### Promjene u `.env` datoteci se ne vide

Pokrenuti:

```bash
php artisan config:clear
php artisan optimize:clear
```

---

## Što nije uključeno u repozitorij

Sljedeći folderi i datoteke ne bi trebali biti uključeni u GitHub repozitorij:

```txt
vendor/
node_modules/
.env
public/build/
public/hot
storage/logs/
```

Oni se ponovno generiraju instalacijom dependencyja i buildanjem projekta.

---

## Sažetak instalacijskih naredbi

```bash
cd C:\laragon\www\travel-booking-app

composer install
npm install

cp .env.example .env
php artisan key:generate

npm run build

php artisan optimize:clear
php artisan config:cache
php artisan view:cache
```

Nakon toga potrebno je importati bazu podataka i otvoriti aplikaciju u pregledniku.

---

## Napomena

Projekt je izrađen u akademske svrhe kao praktični dio završnog rada. Fokus projekta nije samo implementacija travel booking aplikacije, nego analiza i optimizacija performansi web sučelja kroz konkretne promjene u frontend i backend dijelu aplikacije.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
