#!/bin/bash

clear
echo "Will update scripts, web pages, create database and deploy application\n"
echo "Please provide following information to proceed\n"
echo -e -n "\nEnter database user : \c"
read dbuser
echo -e -n "\nEnter database hostname : \c"
read dbhost
echo -e -n "\nEnter database port : \c"
read dbport
echo "\nWill update dbuser: $dbuser , dbhost: $dbhost , dbport: $dbport"

sudo sed -i -e "s/dbuser/$dbuser/g" -e "s/dbhost/$dbhost/g" -e "s/dbport/$dbport/g" create_db.sh site-contacts/*
sudo mv site-contacts/* /var/www/html/
