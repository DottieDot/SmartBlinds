# SmartBlinds

## Prerequisites
- Apache server
- PHP
- MySQL server
- NodeJS + NPM
- Composer

## Install
**Clone repository**
```
git clone https://github.com/DottieDot/SmartBlinds.git
cd SmartBlinds
```
**Create .env file**
```
copy ".env.example" ".env"
```
**Install composer dependencies**
```
composer install
```
**Generate keys**
```
php artisan key:generate
```
**Migrate database**
```
php artisan migrate
```
**Seed database (optional)**
```
composer dump-autoload
php artisan db:seed
```
Or if you want to rebuild your database.
```
php artisan migrate:fresh --seed
```
**Generate OAuth keys**
```
php artisan passport:keys
```
**Install node modules**
```
npm i
```

## Developing

**Server setup**

Configure your apache server to point to the `public/` directory, or run the following command.
```
php artisan serve
```
