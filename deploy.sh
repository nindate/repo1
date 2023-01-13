#!/bin/bash

clear
echo "Will install packages, update scripts, web pages, create database and deploy application\n"
echo "Please provide following information to proceed\n"
echo -e -n "\nEnter database user : \c"
read dbuser
echo -e -n "\nEnter database hostname : \c"
read dbhost
echo -e -n "\nEnter database port : \c"
read dbport

echo "\nInstalling Apache and PHP"
sudo apt update -y && sudo apt install -y apache2 php php-mysql
sudo systemctl restart apache2

echo "\nWill update dbuser: $dbuser , dbhost: $dbhost , dbport: $dbport"
sudo sed -i -e "s/dbuser/$dbuser/g" -e "s/dbhost/$dbhost/g" -e "s/dbport/$dbport/g" create_db.sh site-contacts/*
bash create_db.sh
sudo mv site-contacts/* /var/www/html/

echo "\nYou can now access your Contacts application by launching URL: http://your-server-name/index.php"
