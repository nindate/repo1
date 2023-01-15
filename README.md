repo1
=====

Sample web app for demos. Web app to managed Contacts, uses Apache HTTP with PHP and MySQL database.

Below are steps to setup on Ubuntu

### Install MySQL database on Ubuntu

1. apt update -y && apt install -y mariadb-server


### Install Apache HTTP server, PHP and PHP MySQL connector

1. Update, install git and clone thos repository

```
sudo apt update -y && sudo apt install -y git
```

2. Clone git repository

```
cd /tmp ; git clone https://github.com/nindate/repo1.git
```

3. Run deploy.sh to create necessary database tables in target database, update code with database details and deploy code to /var/www/html

```
cd repo1 ; bash deploy.sh
```
