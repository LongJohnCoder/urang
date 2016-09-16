<b>AUTOMATED SETUP(IN CASE DOES'NT WORK GO FOR MANUAL SET UP)</b> <br/>
1. git clone repo <br/>
2. git checkout development <br/>
3. bash set-up-script.sh <br/>
4. give the inputs it asks to you. <br/>

<b>MANUAL SETUP</b> <br/>
1. git clone repo <br/>
2. checkout to development branch <br/>
3. composer update <br/>
4. php artisan optimize <br/>
5. cp .env.example .env <br/>
6. set up .env <br/>
7. make dump_images, app_images folder <br/>
8. chmod 777 -R public, bootstrap, storage <br/>
9. php artisan migrate <br/>
10. php artisan db:seed <br/>
11. php artisan key:generate <br/>
12. set up .htaccess <br/>
