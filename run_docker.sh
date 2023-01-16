#!/bin/bash

chattr -ai /etc/passwd

chattr -ai /etc/shadow

groupadd www

useradd -g www -p www www 

chown -r www:root cdn_client

chown -r www:root laravel_env_volume

#cover env and run docker
cp cdn_client/.env.production laravel_env_volume/.env


docker-compose up -d