#!/bin/bash

clear
echo -e "\nWill install packages, update scripts, web pages, create database and deploy application"
echo -e "\nPlease provide following information to proceed"
echo -e "\nAre you using locally installed MySQL database or PaaS instance (local / paas)? : \c"
read dbtype
if [[ ${dbtype} == "local" ]]; then
  dbhost=localhost
  dbuser=root
  dbport=3306
  mysql_conn_statement="sudo mysql -u root"
elif [[ ${dbtype} == "paas" ]] ; then
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
  mysql_conn_statement="mysql -u ${dbuser} -h ${dbhost} -P 3306 -p${dbpass2}"
else
  echo -e "\nCorrect options are local and paas. Exiting ..."
  exit 1
fi


echo -e "\nInstalling Apache and PHP"
sudo apt update -y && sudo apt install -y apache2 mariadb-client php php-mysql
sudo systemctl restart apache2

echo -e "\nUpdating scripts and web content"
#echo -e "\nUpdating dbuser: $dbuser , dbhost: $dbhost , dbport: $dbport"
#sudo sed -i -e "s/dbuser/$dbuser/g" -e "s/dbhost/$dbhost/g" -e "s/dbport/$dbport/g" -e "s/dbpass/$dbpass/g" create_db.sh site-contacts/*.php
sudo sed -i -e "s/dbhost/$dbhost/g" -e "s/mysql_conn_statement/$mysql_conn_statement/g" create_db.sh site-contacts/*.php
bash create_db.sh
if [[ $? != 0 ]]; then
  echo -e "\nThere was error while creating the database. Exiting ..."
  exit 1
fi
echo -e "\nDeploying web content"
sudo mv site-contacts/*.php /var/www/html/
if [[ $? == 0 ]]; then
  echo -e "\nYou can now access your Contacts application by launching URL: http://your-server-name/index.php"
else
  echo -e "\nFailed to transfer web content to /var/www/html/"
fi
# Removing the default index.html file since we have index.php instead
sudo rm -f /var/www/html/index.html
