#!/bin/bash
docker network create rede-agenda
#docker container run --name mysql --hostname mysql -e MYSQL_ROOT_PASSWORD=Senha123 -e MYSQL_DATABASE=bd_agenda -d -p 3306:3306 --volume=$PWD/database/dados/:/var/lib/mysql mysql:5.5
#docker container run --name agenda-bd --hostname mysql -d -p 3306:3306 --network rede-agenda --volume=$PWD/database/dados/:/var/lib/mysql mysql:5.5
#docker container run --name mysql --hostname mysql -e MYSQL_ROOT_PASSWORD=Senha123 -e MYSQL_DATABASE=bd_agenda -d -p 3306:3306 --volume=$PWD/database/dados/:/var/lib/mysql mysql:5.7-debian
docker container run --name agenda-bd --hostname mysql -d -p 3306:3306 --network rede-agenda --volume=$PWD/database/dados/:/var/lib/mysql mysql:5.7-debian
#docker container run --name agenda-app --hostname app -d -p 80:80 --network rede-agenda --volume=$PWD/app/dados/:/var/www/html/ php:5.3-apache
docker container run --name agenda-app --hostname app -d -p 80:80 --network rede-agenda --volume=$PWD/app/dados/:/var/www/html/ php:5.6-apache
#docker container run --name agenda-app --hostname app -d -p 80:80 --network rede-agenda --volume=$PWD/app/dados/:/var/www/html/ php:7.4-apache
