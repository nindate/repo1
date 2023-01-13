#!/bin/bash

# Script to create database 'test2', user 'user1' and table structure required for contactsapp
# You can provide appropriate password by replacing 'password' with your password after downloading the script
echo "Creating database"
mysql -u dbuser -h dbhost -P dbport -pdbpass << EOM
create user 'user1'@'%' identified by 'password';
create user 'user1'@'localhost' identified by 'password';
create database test2;
use test2;
grant all privileges on test2.* to 'user1'@'%';
grant all privileges on test2.* to 'user1'@'localhost';
create table Persons (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, FirstName CHAR(40) NOT NULL, LastName CHAR(40) NOT NULL, ContactNo BIGINT NOT NULL, Comments TEXT);
EOM
echo "Database creation script run completed"
