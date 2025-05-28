#!/bin/bash

echo "🧹 Clearing Laravel cache + clear ... "
docker-compose exec -T app php /var/www/html/artisan cache:clear
docker-compose exec -T app php /var/www/html/artisan view:clear
docker-compose exec -T app php /var/www/html/artisan config:clear
docker-compose exec -T app php /var/www/html/artisan optimize:clear
docker-compose exec -T app php /var/www/html/artisan filament:optimize-clear

echo "🧹 removes ALL database content, including constraints and indexes."
docker-compose exec -T app php /var/www/html/artisan db:wipe

echo "🗃️ Refreshing migrations and seeding..."
docker-compose exec -T app php /var/www/html/artisan migrate:refresh --seed

echo "✅ Done!"


