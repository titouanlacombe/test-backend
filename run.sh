#!/bin/bash

declare -a start_flags=("artisan" "serve" "--host=0.0.0.0" "--port=${LARAVEL_PORT_NUMBER}")
start_flags+=("$@")

echo "** Install dependencies **"
composer install

echo "** Copy .env file **"
cp -n .env.example .env

echo "** Generate key ** "
php artisan key:generate

echo "** Update Db **"
php artisan migrate
php artisan db:seed

echo "** Starting Laravel project **"
php "${start_flags[@]}"

