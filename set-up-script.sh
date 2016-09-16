#!/bin/bash
#U-rang set up V2.4 stable
echo "$(tput setaf 1)U-Rang Set up script V2.4 running.......$(tput sgr0)"
chmod +x set-up-script.sh
composer update
php artisan optimize
echo "Setting up database files please wait...."
echo -n "Database name [ENTER]:"
read db_name
echo -n "Database user name [ENTER]:"
read db_usr_name
echo -n "Database password [ENTER]:"
read db_pass
echo "Database set up done successfully!"
cat > .env <<- "EOF"
APP_ENV=local
APP_KEY=SomeRandomString
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306


CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=mail
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=work@tier5.us
MAIL_PASSWORD=!Aworker2#4
MAIL_ENCRYPTION=tls
EOF
sudo echo -e '\nDB_DATABASE= '$db_name '\nDB_USERNAME= '$db_usr_name '\nDB_PASSWORD= '$db_pass >> .env
mkdir public/dump_images
mkdir public/app_images
chmod -R 777 public/
chmod -R 777 bootstrap/
chmod -R 777 storage/
php artisan migrate
php artisan db:seed
composer dump-autoload
php artisan db:seed
php artisan key:generate
cat > .htaccess <<- "EOF"
<IfModule mod_rewrite.c>
<IfModule mod_negotiation.c>
Options -MultiViews
</IfModule>

RewriteEngine On

# Redirect Trailing Slashes If Not A Folder...
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)/$ /$1 [L,R=301]

# Handle Front Controller...
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]

# Handle Authorization Header
RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
</IfModule>
<Files .env>
    Order Allow,Deny
    Deny from all
</Files>
EOF
echo "Set up successfully done! regards - Devil"

