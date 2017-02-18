#!/bin/bash
sudo apt-get -y update
sudo apt-get -y upgrade
sudo apt-get -y install zip
sudo apt-get -y install git
sudo apt-get -y install apache2
sudo apt-get -y install  php libapache2-mod-php php-mcrypt php-mbstring
sudo apt-get -y install php-dom php-curl php-cli
sudo apt-get install php7.0-mysql
sudo phpenmod mcrypt
sudo a2enmod rewrite
sudo service apache2 restart
sudo curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
cd /var/www/html
sudo composer install