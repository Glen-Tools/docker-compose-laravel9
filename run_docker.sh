#!/bin/bash

#cover env and run docker
cp cdn_client/.env.production laravel_env_volume/.env


docker-compose up -d