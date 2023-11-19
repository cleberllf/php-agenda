#!/bin/bash
docker build -t teste-mysql:1.0 .
docker container run --name mysql -d -p 3306:3306  teste-mysql:1.0
