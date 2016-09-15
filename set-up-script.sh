#!/bin/bash
git clone $1
git checkout development
composer update
php artisan optimize
echo "making dependency files, please wait......"
cp .env.example .env
echo "Setting up database files please wait...."
echo -n "Database name [ENTER]:"
read db_name
echo -n "Database user name [ENTER]:"
read db_usr_name
echo -n "Database user name [ENTER]:"
read db_pass
sed -i -e "s/\(DB_DATABASE=\).*/\1$db_name/" \
-e "s/\(DB_USERNAME=\).*/\1$db_usr_name/" \
-e "s/\(DB_PASSWORD=\).*/\1$db_pass/" .env
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
sed -i -e "s/\(MAIL_DRIVER=\).*/\1$mail_driver/" \
-e "s/\(MAIL_HOST=\).*/\1$mail_host/" \
-e "s/\(MAIL_PORT=\).*/\1$mail_port/" \ 
-e "s/\(MAIL_USERNAME=\).*/\1$mail_uname/" \
-e "s/\(MAIL_PASSWORD=\).*/\1$mail_pass/" \
-e "s/\(MAIL_ENCRYPTION=\).*/\1$mail_enc/" .env
echo "Mail setup done successsfully! waiting for furthur prosesses"
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

