#!/bin/bash
git checkout development
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
echo "Mail Server set up is in progress please wait...."
echo -n "Mail Driver [ENTER]:"
read mail_driver
echo -n "Mail Host [ENTER]:"
read mail_host
echo -n "Mail port [ENTER]:"
read mail_port
echo -n "Mail username [ENTER]:"
read mail_uname
echo -n "Mail password [ENTER]:"
read mail_pass
echo -n "Mail encryption [ENTER]:"
read mail_enc
echo "Mail setup done successsfully! waiting for furthur prosesses"
cat > .env <<- "EOF"
APP_ENV=local
APP_KEY=SomeRandomString
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE='$db_name'
DB_USERNAME='$db_usr_name'
DB_PASSWORD='$db_pass'

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER='$mail_driver'
MAIL_HOST='$mail_host'
MAIL_PORT='$mail_port'
MAIL_USERNAME='$mail_uname'
MAIL_PASSWORD='$mail_pass'
MAIL_ENCRYPTION='$mail_enc'
EOF
mkdir public/dump_images
mkdir public/ app_images
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

