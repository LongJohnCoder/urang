<b>AUTOMATED SETUP(IN CASE DOES'NT WORK GO FOR MANUAL SET UP)</b> <br/>
1. git clone repo <br/>
2. git checkout development <br/>
3. bash install <br/>
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

<b> Vagrant set up</b> <br/>
Local Set Up Steps  <br/>
1. Make sure Vagrant is installed locally and works  <br/>
2. vagrant box add ubuntu.16.04 https://cloud-images.ubuntu.com/xenial/current/xenial-server-cloudimg-i386-vagrant.box  <br/>
3. vagrant up  <br/>
4. vagrant ssh  <br/>
5. cd /var/www/html  <br/>
6. sudo bash install <br/>
7. give user id and password it's asking for <br/>
8. sudo bash afterinstall <br/>
 output localhost:8111
