# CDN架構 #
使用docker-compose 建立環境  

## 相關系統版本說明 ##  
-------------
### api 版本 (Docker) ###
- [PHP：8.1.11RC1-fpm-bullseye (Dockerfile FPM)  ](php/Dockerfile)
- [框架：laravel 9 ](cdn_client)
- [Nginx：latest (docker hub 最新版)](docker-compose.yml)   
- [Redis：7.0](docker-compose.yml)  
- [DB：mariadb:10.6](docker-compose.yml)  

### api 設定檔 ###
- [Laravel 環境參數(**docker**)：laravel_env_volume/.env](laravel_env_volume/.env)
- [Laravel 環境參數(**本機**)cdn_client/.env](cdn_client/.env)
- [FPM：php/fpm/www.conf](php/fpm/www.conf)  
- [PHP(.ini)：php/local.ini](php/local.ini)  
- [Nginx：nginx/conf.d/app.conf](nginx/conf.d/app.conf)  
- [Redis：redis.conf](redis/redis.conf)
- [DB：(mysql_conf,mysql_init)](db/config)
- [DB：資料(db_dump)](db/db_dump)

### api log ###
- [Api Log:php/fpm/log](php/fpm/log)
- [Nginx：nginx/log](nginx/log)


## build 說明 ##
-------------
~~docker-compose up -d~~
執行 run_backend_docker.sh (覆蓋.env and run docker)
等待build，成功後直接連結nginx port即可
參考：
>location ^~ /api/v1 {  
>proxy_pass http://localhost:8024/api/v1/;  
>}  

## 相關文件 ## 
-------------
[docker-compose 環境變數設定：.env](.env)
