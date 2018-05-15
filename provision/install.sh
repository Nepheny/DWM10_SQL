#!/bin/bash

#install programms
sudo apt update
sudo apt install -y mysql-server phpmyadmin
sudo apt install -y vim curl git wget

#create a user for mysql and add the database
sudo su
mysql --database=mysql -e "CREATE USER 'crystal'@'localhost' IDENTIFIED BY 'crystal';"
mysql --database=mysql -e "CREATE USER 'crystal'@'%' IDENTIFIED BY 'crystal';"
mysql --database=mysql -e "GRANT ALL ON *.* TO 'crystal'@'localhost';"
mysql --database=mysql -e "GRANT ALL ON *.* TO 'crystal'@'%';"
mysql -e /vagrant/provision/blog.sql
exit

#configure VM
sudo cp /provision/php.ini /etc/php/7.0/apache2/php.ini
sudo rm -r /var/www/html/
sudo ln -s /vagrant/web /var/www/html