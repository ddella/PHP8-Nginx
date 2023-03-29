# Set master image, Mini root filesystem from https://www.alpinelinux.org/downloads/
# Use the following command to build the Docker image:
#   docker build -t php81_nginx:3.17.3 .
# (Optional) If you suspect somethings wrong, you can start the container with the command:
#   docker run -it --rm --name php81_nginx php81_nginx:3.17.3 /bin/sh
#
FROM scratch
ADD ["alpine-minirootfs-3.17.3-x86_64.tar.gz", "/"]

#FROM alpine:3.17.1

LABEL Maintainer="DDN <daniel@isociel.com>"
LABEL Description="Lightweight container with Nginx and PHP 8.1 on Alpine 3.17.3"

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
RUN ["apk", "--no-cache", "add", "php81", "php81-fpm", "php81-pdo", "php81-pdo_mysql", "php81-mysqli"]
COPY php.sh /tmp
RUN ["/bin/sh", "/tmp/php.sh"]
RUN ["rm", "-f", "/tmp/php.sh"]

# Copy recursively local html/php files & set user/group
COPY --chown=www:www ./www/ /www/

# Expose port 80, 443
EXPOSE 80
EXPOSE 443

# Start PHP-fpm (FastCGI Process Manager) and Nginx
COPY ["entrypoint.sh", "/root"]
ENTRYPOINT ["sh", "/root/entrypoint.sh"]
