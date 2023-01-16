#!/bin/bash

clear
echo -e "Will install packages, update scripts, web pages, create database and deploy application\n"
echo -e "Please provide following information to proceed\n"
echo -e "\nEnter database hostname : \c"
read dbhost
#echo -e "\nEnter database port : \c"
#read dbport
dbport=3306
echo -e "\nEnter database user : \c"
read dbuser
echo -e "\nEnter password for user $dbuser : \c"
read -s dbpass
echo -e "\nEnter password again : \c"
read -s dbpass2

if [[ ${dbpass} != ${dbpass2} ]]; then
  echo -e "\nPasswords did not match. Exiting ...\n"
  exit 1
fi

echo -e "\nInstalling Apache and PHP"
sudo apt update -y && sudo apt install -y apache2 mariadb-client php php-mysql
sudo systemctl restart apache2

echo -e "\nUpdating dbuser: $dbuser , dbhost: $dbhost , dbport: $dbport"
sudo sed -i -e "s/dbuser/$dbuser/g" -e "s/dbhost/$dbhost/g" -e "s/dbport/$dbport/g" -e "s/dbpass/$dbpass/g" create_db.sh site-contacts/*.php
bash create_db.sh
rm create_db.sh
echo -e "\nDeploying web content"
sudo mv site-contacts/*.php /var/www/html/
if [[ $? == 0 ]]; then
  echo -e "\nYou can now access your Contacts application by launching URL: http://your-server-name/index.php"
else
  echo -e "\nFailed to transfer web content to /var/www/html/"
fi
rm -rf site-contacts
