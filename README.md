PHP verzia - 8.5.1 
Composer verzia - 2.9.5 
Laravel Installer verzia - 5.24.4 
Databaza - MySQL 
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=todoapp
        DB_USERNAME=root
        DB_PASSWORD=

Tailwindcss - 4.0.0


- Inštrukcie na inštaláciu projektu
    + Stiahnuť projekt (source code), rozzipovať a otvoriť v    obľubenom Code Editore.
    + Alternatíva clone: 
        git clone https://github.com/MarosPapan/todoApp.git
        cd todoapp

    + v terminály (cmd) navigovať do koreňového priečinka projektu

    + Nainštalovať PHP závislosti: composer install

    + Nainštalovať Node.js závislosti: npm install

    + Skopírovať .env súbor: .env.example. -> copy -> .env

    + Generovať aplikačný kľúč: php artisan key:generate

    + Nastaviť databázu v .env: 
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=todoapp
        DB_USERNAME=root
        DB_PASSWORD=
    
    + APACHE vytvoriť databázu s názvom: todoapp

    + Spustiť migrácie: php artisan migrate 

    + Spustiť seeder (testovacie dáta): php artisan db seed 
        + alternatíva: php artisan migrate:fresh --seed

    + Spustenie APlikácie (serveru): http://localhost:8000/
        + npm run dev (v jednom terminali pre VITE)
        + php artisan serve (v inom terminaly pre LARAVEL)