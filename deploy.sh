#!/bin/bash

clear
echo "Will install packages, update scripts, web pages, create database and deploy application\n"
echo "Please provide following information to proceed\n"
echo -e -n "\nEnter database hostname : \c"
read dbhost
echo -e -n "\nEnter database port : \c"
read dbport
echo -e -n "\nEnter database user : \c"
read dbuser
echo -e -n "\nEnter password for user $dbuser : \c"
read -s dbpass

echo -e -n "\nInstalling Apache and PHP"
sudo apt update -y && sudo apt install -y apache2 mariadb-client php php-mysql
sudo systemctl restart apache2

echo -e -n "\nWill update dbuser: $dbuser , dbhost: $dbhost , dbport: $dbport"
sudo sed -i -e "s/dbuser/$dbuser/g" -e "s/dbhost/$dbhost/g" -e "s/dbport/$dbport/g" -e "s/dbpass/$dbpass/g" create_db.sh site-contacts/*
bash create_db.sh
sudo mv site-contacts/* /var/www/html/

echo -e -n "\nYou can now access your Contacts application by launching URL: http://your-server-name/index.php"
