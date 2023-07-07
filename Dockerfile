# Set master image, Mini root filesystem from https://www.alpinelinux.org/downloads/

# You can uncomment the following line and comment the following two (2) lines
# and you won't have to download the mini root filesystem

FROM alpine:3.18.2
# FROM scratch
# ADD ["alpine-minirootfs-3.18.2-x86_64.tar.gz", "/"]

LABEL org.opencontainers.image.authors="DDN <daniel@isociel.com>"
LABEL version="2.20"
LABEL Description="Lightweight container with Nginx 1.25 and PHP 8.2 on Alpine 3.18.2"

# Nginx mainline and PHP 8.2 installation with some other utilities
RUN ["apk", "--no-cache", "add", "php82", "php82-fpm", "php82-pdo", "php82-pdo_mysql", "php82-mysqli", "curl", "socat", "openssl", "ca-certificates", "nginx"]
# RUN ["apk", "--no-cache", "add", "php82", "php82-fpm", "php82-pdo", "php82-pdo_mysql", "php82-mysqli", "curl", "socat", "tshark"]

# Prepare Nginx Installation
COPY ["nginx.sh", "/tmp"]
RUN ["/bin/sh", "/tmp/nginx.sh"]

# Copy Nginx configuration file
COPY ["nginx.conf", "/etc/nginx/"]

# Copy SSL certificate
RUN ["mkdir", "-p", "/etc/nginx/certificate/"]
COPY --chown=www:www nginx-crt.pem /etc/nginx/certificate/

# Copy SSL key & set permission
COPY ["nginx-key.pem", "/etc/nginx/certificate/nginx-key.pem"]
RUN ["chmod", "400", "/etc/nginx/certificate/nginx-key.pem"]

COPY ["php.sh", "/tmp"]
RUN ["/bin/sh", "/tmp/php.sh"]

# Cleanup
RUN ["rm", "-f", "/tmp/nginx.sh", "/tmp/php.sh"]

# Copy recursively local html/php files & set user/group
COPY --chown=www:www ./www/ /www/

# Expose port 80, 443
EXPOSE 80
EXPOSE 443

# Start PHP-fpm (FastCGI Process Manager), TCP & UDP listener and Nginx
COPY ["entrypoint.sh", "/home/www"]
ENTRYPOINT ["/bin/sh", "/home/www/entrypoint.sh"]
