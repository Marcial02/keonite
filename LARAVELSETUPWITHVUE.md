Download : herd.laravel.com

# 1. Install Laravel core
composer create-project laravel/laravel .

herd link

# 2. Install Breeze for Auth
composer require laravel/breeze --dev

touch resources/js/bootstrap.js

# 3. Install the Vue version of Breeze
# (Piliin mo ang 'Vue' at 'No' sa optional features para simple lang)
php artisan breeze:install vue

[find: resources/js/Pages/]

npm install @remixicon/vue

fix databes in .env file

also in .env:
APP_ENV=production
APP_DEBUG=false

in gitignore file, put # in /public/build

in package.json:
scripts{
"deploy": "npm run build && git add . && git commit -m 'Auto-deploy Keonite' && git push origin main" 
}

