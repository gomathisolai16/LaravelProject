#!/usr/bin/env bash

#before start please be sure that your .env file exists and your database configurations are correct

#git pull
sudo git pull

# update composer to latest version
composer self-update

# install required packages (vendor)
composer install

# generate application key
# php artisan key:generate

# migrate database files
php artisan migrate

# restart the queue with new changes
php artisan queue:restart

if [ "$1" = "seed" ]
then
    # for development version add fake data
    php artisan db:seed #comment this line (php artisan db:seed) on production version
fi

# change perission in order to work properly for storage directory
sudo chmod -R 777 storage/generated
sudo chmod -R 777 storage/framework
sudo chmod -R 777 storage/logs

# install passport package requirements
php artisan passport:install

# clear cache
php artisan cache:clear

# change directory to frontend-app
cd frontend-app

# install project dependencies
npm install

# start build command based on the environment
if [ "$1" = "dev" ]
then
    npm run build:dev
elif [ "$1" = "qa" ]
then
    npm run build:qa
elif [ "$1" = "stag" ]
then
    npm run build:stag
elif [ "$1" = "prod" ]
then
    npm run build:prod
else
    ng build --prod --aot --environment=$1
fi

sudo chmod -R 777 dist
# copy .htaccess
cp .htaccess ./dist

cat /dev/null > ../storage/logs/laravel.log
sudo chmod 777 ../storage/logs/laravel.log

npm run versionTagDependencies
