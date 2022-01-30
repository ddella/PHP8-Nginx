# Alpine Linux Nginx/PHP 8 for Docker
# Version
## Last Version
|Name|Version|
|:---|:---|
|**Alpine**|3.15.0|
|**NGINX**|1.20.2|
|**PHP8**|8.0.14|

# Introduction
This will build a Docker image, from scratch. It is based on Alpine Linux 3.15, Nginx 1.20 and PHP 8.
Three files will be copied on the ```www``` directory of the container.  
This container can be used to test a ```load balancer``` fronting a farm of web servers.
Just point your browser to your load balancer with the following url and the page gives you lots of information about the request.
```url
http://<load balancer>/phpvariables.php
```

1. ```index.html``` -> The main page when accessing the web server
2. ```phpinfo.php``` -> This is the phpinfo() function
3. ```phpvariables.php``` -> This is the phpinfo(INFO_VARIABLES) function
4. ```superglobals.php``` -> This is a self made file based on phpinfo() function

The build is in four steps:

1. Start by downloading the Alpine mini root filesystem.
2. Build the Docker container with the minirootfs.
```Docker
# Set master image
FROM scratch
ADD alpine-minirootfs-3.15.0-x86_64.tar.gz /
...
```
3. Install Nginx and PHP 8.
4. Copy and execute some scripts to finalize the installation.

# Alpine Mini Root FileSystem
This will build a Docker image from scratch. It will be based on Alpine Linux 3.15.0 and we will install the minimum PHP8.
Download the Mini root filesystem and place it in the same directory as the ```Dockerfile```.
https://dl-cdn.alpinelinux.org/alpine/v3.15/releases/x86/alpine-minirootfs-3.15.0-x86.tar.gz
```sh
# Copy all the files for GitHub to your local drive.
git clone https://github.com/ddella/PHP8-Nginx.git
cd php8-nginx

# Get the Alpine Mini Root FileSystem (~2.7MB).
curl -O https://dl-cdn.alpinelinux.org/alpine/v3.15/releases/x86/alpine-minirootfs-3.15.0-x86.tar.gz
```
## Build the Docker image from scratch. Don't forget the '.' at the end of the command.
```sh
docker build -t php8_nginx .
```

# Running the container locally
If you have Docker locally installed, the following commands will run your container.

This will run the container.

```HTTP```  : TCP port 80, inside the container, will be mapped to port 8080 of your local PC.  
```HTTPS```: TCP port 443, inside the container, will be mapped to port 8443 of your local PC.
```sh
docker run --rm -d -p 8080:80 -p 8443:443 --name web php8_nginx
```

# Testing the container
Open your browser and type the following url to access the default page of the container with HTTP.
```url
http://localhost:8080
```

Open your browser and type the following url to access the default page of the container with HTTPS.
You will get an error from your browsing about the ```self signed``` certificate. This error can be safely ignored.
```url
https://localhost:8443
```

# Terminate the container
This will terminate the container launched in the preceding step:
```sh   
docker rm -f web
```

# Container size
The size of the container is only ~30MB.

# Troubleshooting ONLY
This command gives you a shell access to the container. Not to be used in production.

```bash
docker run -it --rm --entrypoint /bin/sh --name test php8_nginx
```
The container will terminate as soon as you exit the shell.

This will run the container and map a local directory, in our case ```Downloads```, to the ```www``` directory inside the container.  
You can now change the ```html``` or ```php``` files without rebuilding the image.
```sh
docker run --rm -d -p 8080:80 -p 8443:443 --name test -v ~/Downloads/:/www php8_nginx
```

# [CHANGELOG](./CHANGELOG.md)

# License
This project is licensed under the [MIT license](LICENSE).
