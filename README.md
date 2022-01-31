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
4. ```superglobals.php``` -> This is a self made file, based on phpinfo() function (not very useful 😀)

The build is a five step process:

1. Clone the files from github.
2. Download the Alpine mini root filesystem. We start our container with this. See an extract of the ```Dockerfile```.
```Docker
# Set master image
FROM scratch
ADD alpine-minirootfs-3.15.0-x86_64.tar.gz /
...
```
3. Build the Docker container.
4. Install Nginx, PHP 8 and execute some scripts to finalize the installation.
5. Run the container.

# Copy all the files needed to build the image
This will build a Docker image from scratch. It will be based on Alpine Linux 3.15.0 with Nginx web server and PHP8.
```sh
# Copy all the files for GitHub to your local drive.
git clone https://github.com/ddella/PHP8-Nginx.git
cd php8-nginx
```

# Alpine Mini Root FileSystem
Download Alpine mini root filesystem and place it in the same directory as ```Dockerfile```.
```sh
# Get the Alpine Mini Root FileSystem (~2.7MB).
curl -O https://dl-cdn.alpinelinux.org/alpine/v3.15/releases/x86/alpine-minirootfs-3.15.0-x86.tar.gz
```

# Build the Docker image from scratch.
This command builds the Docker image. Don't forget the ```.``` at the end of the command.
```sh
docker build -t php8_nginx .
```

# Running the container locally
The following commands will run your container.
```sh
docker run --rm -d -p 8080:80 -p 8443:443 --name web php8_nginx
```
Port mapping for ```HTTP```  : TCP port ```80```, inside the container, will be mapped to port ```8080``` on the local host.  
Port mapping for ```HTTPS``` : TCP port ```443```, inside the container, will be mapped to port ```8443``` on the local host.  
The  ```8080``` and  ```8443``` can be changed. They're the ports on the local Docker host.

# Testing the container
## HTTP
Open your browser and type the following url to access the default page of the container with HTTP.
```url
http://localhost:8080
```
## HTTPS
Open your browser and type the following url to access the default page of the container with HTTPS.
You will get an error from your browser about the ```self signed``` certificate. This error can be safely ignored.  
If this really bothers you, you can change the files ```nginx-certificate.crt```and ```nginx.key```.
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
## Shell access to the container
This command gives you a shell access to the container. Not to be used in production.
```bash
docker run -it --rm --entrypoint /bin/sh --name test php8_nginx
```
The container will terminate as soon as you exit the shell.

## Map container ```www```directory locally
This will run the container and map a local directory, in our case ```Downloads```, to the root directory of Nginx, ```www```, inside the container.  
That gives you the possibility to change (test) the ```html``` or ```php``` files without rebuilding the image.
```sh
docker run --rm -d -p 8080:80 -p 8443:443 --name web -v ~/Downloads/:/www php8_nginx
```

## Map container ```log```directory locally
This will run the container and map a local directory, in our case ```Downloads```, to the log directory of Nginx, ```/var/log/nginx```, inside the container.  
That gives you the possibility to look at the Nginx log files.
```sh
docker run --rm -d -p 8080:80 -p 8443:443 --name web -v ~/Downloads/:/var/log/nginx php8_nginx
```
## Terminate container
Don't forget to terminate the container when you're done:
```sh   
docker rm -f web
```

# [CHANGELOG](./CHANGELOG.md)

# License
This project is licensed under the [MIT license](LICENSE).
