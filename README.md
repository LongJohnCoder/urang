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