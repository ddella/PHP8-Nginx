# Nginx and PHP 8 for Docker
# Version
## Last Version
|Name|Version|Docker tag|
|:---|:---|:---:|
|**Alpine**|3.15.0| 3.15.0 |
|**NGINX**|1.20.2| 1.20 |
|**PHP8**|8.0.14| 8.0 |

# Introduction
This will build a Docker image from scratch. It is based on Alpine Linux 3.15.0 and PHP 8.
Three files will be copied on the www directory of the container.

1. index.html -> The main page when accessing the web server
2. phpinfo.php -> This is the phpinfo() function
3. phpvariables.php -> This is the phpinfo(INFO_VARIABLES) function

The build is in four steps:

1. Start by downloading the Alpine mini root filesystem.
2. Build the Docker container with the minirootfs.
```Docker
# Set master image
FROM scratch
ADD alpine-minirootfs-3.15.0-x86_64.tar.gz /
<See the Dockerfile for the complete commands>
...
```
3. Install Nginx and PHP 8.
4. Copy and execute some scripts to finalize the installation.

# Alpine Mini Root FileSystem
This will build a Docker image from scratch. It will be based on Alpine Linux 3.15.0 and we will install the minimum PHP8.
Download the Mini root filesystem and place it in the same directory as the Dockerfile.
https://dl-cdn.alpinelinux.org/alpine/v3.15/releases/x86/alpine-minirootfs-3.15.0-x86.tar.gz
```sh
# Get all the files for GitHub
git clone https://github.com/daniel/docker-php8-nginx.git
cd php8-nginx

# Get Alpine Mini Root FileSystem
curl https://dl-cdn.alpinelinux.org/alpine/v3.15/releases/x86/alpine-minirootfs-3.15.0-x86.tar.gz

# Build the Docker image from scratch
docker build -t php8_nginx .
```

# Running
This will run the container, if you have Docker locally installed.
```sh   
docker run --rm -d -p 8080:80 --name web php8_nginx
```

# Testing
You can then browse to ```http://localhost:8080``` to view the default page.

# Terminate the container
This will terminate the container launched in the preceeding step:
```sh   
docker rm -f web
```

# Container size
The size of the container is 30.3MB.

# Troubleshooting ONLY
This command gives you a shell access to the container. Not to be used in production.

```bash
docker run -it --rm --entrypoint /bin/sh --name web1 php8_nginx
```
The container will terminate as soon as you exit the shell.

# [CHANGELOG](./CHANGELOG)

# License
This project is licensed under the [MIT license](LICENSE).
