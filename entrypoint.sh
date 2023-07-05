#!/usr/bin/env sh
set -e

php-fpm81 -D

# TCP and UDP listener
socat TCP-LISTEN:${TCP_PORT},reuseaddr,fork SYSTEM:"echo \$\(date\); echo TCP Server\: \$SOCAT_SOCKADDR\:\$SOCAT_SOCKPORT; echo Client\: \$SOCAT_PEERADDR\:\$SOCAT_PEERPORT; echo; cat",nofork &
socat UDP-LISTEN:${UDP_PORT},reuseaddr,fork SYSTEM:"echo \$\(date\); echo UDP Server\: \$SOCAT_SOCKADDR\:\$SOCAT_SOCKPORT; echo Client\: \$SOCAT_PEERADDR\:\$SOCAT_PEERPORT; echo; cat",nofork &

nginx -g 'daemon off;'
