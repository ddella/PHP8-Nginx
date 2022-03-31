# Set master image, Mini root filesystem from https://www.alpinelinux.org/downloads/
FROM scratch
ADD ["alpine-minirootfs-3.15.3-x86_64.tar.gz", "/"]

LABEL Maintainer="DDN <daniel@isociel.com>"
LABEL Description="Lightweight container with Nginx and PHP 8 on Alpine 3.15."

# Nginx Installation
COPY nginx.sh /tmp
RUN ["/bin/sh", "/tmp/nginx.sh"]
RUN ["rm", "-f", "/tmp/nginx.sh"]
# Copy Nginx configuration file
COPY ["nginx.conf", "/etc/nginx/"]
# Copy SSL certificate
RUN ["mkdir", "-p", "/etc/nginx/certificate/"]
COPY --chown=www:www nginx-certificate.crt /etc/nginx/certificate/nginx-certificate.crt

# Copy SSL key & set permission
COPY ["nginx.key", "/etc/nginx/certificate/nginx.key"]
RUN ["chmod", "400", "/etc/nginx/certificate/nginx.key"]

# PHP8 Installation
RUN ["apk", "--no-cache", "add", "php8", "php8-fpm", "php8-pdo", "php8-pdo_mysql", "php8-mysqli"]
COPY php8.sh /tmp
RUN ["/bin/sh", "/tmp/php8.sh"]
RUN ["rm", "-f", "/tmp/php8.sh"]

# Copy recursively local html/php files & set user/group
COPY --chown=www:www ./www/ /www/

# Expose port 80, 443
EXPOSE 80
EXPOSE 443

# Start PHP-fpm (FastCGI Process Manager) and Nginx
COPY ["entrypoint.sh", "/root"]
ENTRYPOINT ["sh", "/root/entrypoint.sh"]
