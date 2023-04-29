#!/bin/sh
echo "Hello, Kubernetes from Pod [$(hostname)] at IP [$(hostname -i)]: $(TZ=America/Montreal date)!"
