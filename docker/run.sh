#!/bin/sh

cd /var/www

# Instalção dos pacotes do projeto
composer update

# Dando permissão para pasta public
chmod -R 775 /var/www/public

# Dando permissão para pasta bootstrap
chmod -R 777 /var/www/bootstrap

# Executando script de deploy
sh clear_deploy.sh

# Criando tabelas nao existentes
php artisan migrate --force

touch /var/www/storage/logs/laravel.log

# Dando permissão para pasta storage
chmod -R 777 /var/www/storage

# Startando Supervisor
service supervisor start

exec "$@"
