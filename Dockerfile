# to build: docker build -t php8_nginx .
# to run: docker run --rm -d -p 4000:80 --name web php8_nginx
# to run with shell (debug ONLY): docker run -it --rm --entrypoint /bin/sh --name web1 php8_nginx
# to shutdown: docker rm -f web

# https://wiki.alpinelinux.org/wiki/Nginx_with_PHP#Configuration_of_PHP7

# Set master image
FROM scratch
ADD alpine-minirootfs-3.15.0-x86_64.tar.gz /

LABEL Maintainer="DDN <daniel@isociel.com>"
LABEL Description="Lightweight container with Nginx latest with Nginx latest on Alpine."

# Nginx Installation
RUN apk --no-cache upgrade && apk add --no-cache nginx

# PHP8 Installation
RUN apk --no-cache add php8 php8-fpm

COPY php8.sh /root
# Make the script 'executable'. Prevents the error: permission denied unknown
RUN ["chmod", "+x", "/root/php8.sh"]
RUN ["/root/php8.sh"]

# Creating new user and group 'www' for nginx 
RUN adduser -D -g 'www' www

# Create a directory for html files
RUN mkdir /www
RUN chown -R www:www /var/lib/nginx
RUN chown -R www:www /www

# Copy Nginx configuration file
COPY nginx.conf /etc/nginx/

# Copy existing application directory permissions
COPY --chown=www-data:www-data ./www/* /www/

# Expose port 80 and start Nginx
EXPOSE 80

COPY entrypoint.sh /root
ENTRYPOINT ["sh", "/root/entrypoint.sh"] 
