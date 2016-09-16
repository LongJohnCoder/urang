//====================AUTOMATED SETUP(IN CASE DOES'NT WORK GO FOR MANUAL SET UP)==========================//
1. git clone repo
2. git checkout development
3. ./set-up-script.sh (stable v2.4)
4. give the inputs it asks to you.

//====================MANUAL SETUP========================================================================//
1. git clone repo
2. checkout to development branch
3. composer update
4. php artisan optimize
5. cp .env.example .env
6. set up .env
7. make dump_images, app_images folder
8. chmod 777 -R public, bootstrap, storage
9. php artisan migrate
10. php artisan db:seed
11. php artisan key:generate
12. set up .htaccess