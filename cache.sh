sudo chown -R www-data:www-data app/cache
sudo chmod -R 777 app/cache
sudo chown -R www-data:www-data app/logs
sudo chmod -R 777 app/logs
php app/console cache:clear
sudo chown -R www-data:www-data app/cache
sudo chmod -R 777 app/cache
sudo chown -R www-data:www-data app/logs
sudo chmod -R 777 app/logs

