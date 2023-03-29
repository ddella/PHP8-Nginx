#!/usr/bin/env sh
set -e

php-fpm81 -D
nginx -g 'daemon off;'
