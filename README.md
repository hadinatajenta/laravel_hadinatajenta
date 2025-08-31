# Test Terakorp

## setup and instalation
1. Clone and setup project
```
    git clone https://github.com/hadinatajenta/laravel_hadinatajenta.git
    cd laravel_hadinatajenta
```
2. Install dependencies:
```
    composer install
    npm install && npm run dev
```

3. Copy .env:
```
    cp .env.example .env
    php artisan key:generate
```

4. Migrate & seeding :
```
    php artisan migrate --seed
```
5. Run app
```
    php artisan serve
```
