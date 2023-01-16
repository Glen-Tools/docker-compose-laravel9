#!/bin/bash

# chattr -ai /etc/passwd

# chattr -ai /etc/shadow

# groupadd www

# useradd -g www -p www www 

# chown -R 1000:1000 cdn_client

# chown -R www:root laravel_env_volume



#cover env and run docker
cp cdn_client/.env.production laravel_env_volume/.env

chown -R 1000:1000 cdn_client db/config laravel_env_volume nginx php redis 

docker-compose up -d