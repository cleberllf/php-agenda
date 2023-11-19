#!/bin/bash
docker build -t teste-app:1.0 .
docker container run --name web-app -d -p 80:80 teste-app:1.0
