#!/usr/bin/env sh
set -e

php-fpm82 -D

# Run TCP and UDP listenes as user 'www'
su www -c 'socat TCP-LISTEN:${TCP_PORT},reuseaddr,fork SYSTEM:"echo \$\(date\); echo TCP Server\: \$SOCAT_SOCKADDR\:\$SOCAT_SOCKPORT; echo Client\: \$SOCAT_PEERADDR\:\$SOCAT_PEERPORT; echo; cat",nofork &'
su www -c 'socat UDP-LISTEN:${UDP_PORT},reuseaddr,fork SYSTEM:"echo \$\(date\); echo UDP Server\: \$SOCAT_SOCKADDR\:\$SOCAT_SOCKPORT; echo Client\: \$SOCAT_PEERADDR\:\$SOCAT_PEERPORT; echo; cat",nofork &'

nginx -g 'daemon off;'
