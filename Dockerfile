# Set master image
FROM scratch
ADD alpine-minirootfs-3.15.0-x86_64.tar.gz /

LABEL Maintainer="DDN <daniel@isociel.com>"
LABEL Description="Lightweight container with Nginx and PHP 8 on Alpine."

# Nginx Installation
RUN apk --no-cache upgrade && apk add --no-cache nginx

# PHP8 Installation
RUN apk --no-cache add php8 php8-fpm

COPY php8.sh /root
# Make the script 'executable'. Prevents the error: permission denied unknown
RUN ["chmod", "+x", "/root/php8.sh"]
RUN ["/root/php8.sh"]

# Creating new user and group 'www' for nginx 
RUN adduser -D -g www www

# Create a directory for html files
RUN mkdir /www
RUN chown -R www:www /var/lib/nginx
RUN chown -R www:www /www

# Copy Nginx configuration file
COPY nginx.conf /etc/nginx/

# Copy SSL key & certificate
RUN ["mkdir", "-p", "/etc/nginx/certificate/"]
COPY --chown=www:www nginx-certificate.crt /etc/nginx/certificate/nginx-certificate.crt

COPY nginx.key /etc/nginx/certificate/nginx.key
RUN ["chmod", "400", "/etc/nginx/certificate/nginx.key"]

# Copy existing application directory permissions
COPY --chown=www:www ./www/* /www/

# Expose port 80, 443 and start Nginx
EXPOSE 80
EXPOSE 443

COPY entrypoint.sh /root
ENTRYPOINT ["sh", "/root/entrypoint.sh"] 
