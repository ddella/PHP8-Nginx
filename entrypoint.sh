#!/usr/bin/env sh
set -e

php-fpm8 -D
nginx -g 'daemon off;'
