repo1
=====

## Sample web app for demos. 

Web app to managed Contact. Uses Apache HTTP with PHP and MySQL database.

*Below are the steps to setup on Ubuntu*

**Install MySQL database**

1. Update and install package

```
apt update -y && apt install -y mariadb-server
```


**Install Apache HTTP server, PHP and PHP MySQL connector**

1. Update, install git and clone this repository

```
sudo apt update -y && sudo apt install -y git
```


```
cd /tmp ; git clone https://github.com/nindate/repo1.git
```

2. Run deploy.sh to install apache, php, create necessary database tables in target database, update code with database details and deploy code to /var/www/html

```
cd repo1 ; bash deploy.sh
```
