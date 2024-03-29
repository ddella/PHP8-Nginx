#!/bin/sh

# Install use mainline nginx packages
printf "%s%s%s%s\n" "@nginx http://nginx.org/packages/mainline/alpine/v" `egrep -o '^[0-9]+\.[0-9]+' /etc/alpine-release` "/main" | tee -a /etc/apk/repositories

# import an official nginx signing key so apk could verify the packages authenticity
curl -o /tmp/nginx_signing.rsa.pub https://nginx.org/keys/nginx_signing.rsa.pub

# move the key to apk trusted keys storage
mv /tmp/nginx_signing.rsa.pub /etc/apk/keys/

# Create a user for Nginx
adduser -D www www

# Create the root directory for Nginx & set permissions
mkdir /www
chown -R www:www /usr/share/nginx
chown -R www:www /www
