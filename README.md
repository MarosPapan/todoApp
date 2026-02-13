***
# 📝 TodoApp – Laravel 12 + MySQL + TailwindCSS

## 🚀 Použité technológie

- **PHP:** 8.5.1  
- **Composer:** 2.9.5
- **Laravel:** 12.50.0
- **Laravel Installer:** 5.24.4  
- **Databáza:** MySQL  
- **TailwindCSS:** 4.0.0
- 

***

## 📥 Inštalácia projektu

### 1. Stiahnutie projektu

#### A) ZIP verzia

1.  Stiahni projekt
2.  Rozbaľ ZIP
3.  Otvor priečinok v obľúbenom editore (VS Code)

#### B) Git clone

```bash
git clone https://github.com/MarosPapan/todoApp.git
cd todoapp
```

***

### 2. Prejdi do koreňového priečinka projektu

```bash
cd /cesta/k/projektu
```

***

### 3. Nainštaluj PHP závislosti

```bash
composer install
```

***

### 4. Nainštaluj Node.js závislosti

```bash
npm install
```

***

### 5. Skopíruj environment súbor

```bash
cp .env.example .env
```

***

### 6. Vygeneruj aplikačný kľúč

```bash
php artisan key:generate
```

***

### 7. Nastav databázu

Vytvor MySQL databázu s názvom (APACHE):

    todoapp

Potom nastav údaje v `.env` súbore
## 🔧 Nastavenie databázy

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todoapp
DB_USERNAME=root
DB_PASSWORD=
````

***

### 8. Spusti migrácie

```bash
php artisan migrate
```

***

### 9. Naplň databázu testovacími dátami (voliteľné)

```bash
php artisan db:seed
```

alebo:

```bash
php artisan migrate:fresh --seed
```

***

## ▶️ Spustenie aplikácie

### 1. Spusti Laravel server

```bash
php artisan serve
```

Aplikácia beží na:  
👉 <http://localhost:8000/>

### 2. Spusti vývojový režim (Vite)

```bash
npm run dev
```

***

## 🎉 Hotovo!

 
