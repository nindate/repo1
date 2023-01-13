repo1
=====

Sample web app to manage contacts. Uses PHP code with MySQL database.

Install Apache HTTP server, PHP and PHP MySQL connector

On Ubuntu
---------

1. Update, install git and clone thos repository

```
sudo apt update -y && sudo apt install -y git
```

2. Clone git repository

```
cd /tmp
git clone https://github.com/nindate/repo1.git
```

3. Run deploy.sh to create necessary database tables in target database, update code with database details and deploy code to /var/www/html

```
cd repo1
bash deploy.sh
```
