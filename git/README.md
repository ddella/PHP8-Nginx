# Nginx and PHP8 for Docker

# Version
## Last Version
|Name|Version|Docker tag|   
|:---|:---|:---:|   
|**NGINX**|1.20.2| - |   
|**PHP**|8.0.14| 8.0 |
|**PHP**|7.4.27| 7.4 |

# Include extensions
```bash
bcmath,Core,ctype,curl,date,dom,exif,fileinfo,filter,ftp,gd,gettext,hash,iconv,intl,json,libxml,mbstring,mysqli,mysqlnd,openssl,pcntl,pcre,PDO,pdo_mysql,pdo_pgsql,pdo_sqlite,pgsql,Phar,posix,redis,Reflection,session,shmop,SimpleXML,soap,sockets,sodium,SPL,sqlite3,standard,sysvsem,tokenizer,xml,xmlreader,xmlwriter,xsl,zip,zlib
```
> [Custom extension](./extensions)

# Docker Hub   
**Nginx-PHP:** [https://hub.docker.com/r/devcto/nginx-php](https://hub.docker.com/r/devcto/nginx-php)   

- **[WebSite](http://nginx-php.222029.xyz)**
- [Documents](./docs)
- [Extensions](./extensions)

# Build
```sh
git clone https://github.com/skiy/docker-nginx-php.git

cd nginx-php

docker build --build-arg PHP_VERSION="8.1.1" \
  --build-arg NGINX_VERSION="1.20.0" \
  -t nginx-php:8.1 \
  -f ./Dockerfile .
```

# Installation
Pull the image from the docker index rather than downloading the git repo. This prevents you having to build the image on every docker host.

```sh   
docker pull devcto/nginx-php:latest
```

# Running
To simply run the container:

```sh
docker run --name nginx -p 8080:80 -d devcto/nginx-php
```
You can then browse to ```http://\<docker_host\>:8080``` to view the default install files.

## docker-compose.yaml
```yaml
version: '3'
services:
  nginx-php:
    image: devcto/nginx-php:latest
    ports:
      - "38080:80"
```

# Command line tools
Use `docker exec {CONTAINER ID} {COMMAND}`

```bash
# Current process
docker exec {CONTAINER ID} ps -ef
# Current PHP version
docker exec {CONTAINER ID} php --version

# supervisord
## HELP
docker exec {CONTAINER ID} supervisorctl --help
## STOP, START, STATUS (stop/start/status)
docker exec {CONTAINER ID} supervisorctl stop all
## STOP NGINX / PHP
docker exec {CONTAINER ID} supervisorctl stop nginx/php-fpm

# Container not started
## PHP version
docker run --rm -it devcto/nginx-php:latest php --version

## NGINX version
docker run --rm -it devcto/nginx-php:latest nginx -v
```

# [CHANGELOG](./CHANGELOG)

# License
This project is licensed under the [MIT license](LICENSE).   
